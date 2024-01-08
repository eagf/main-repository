import { StatusBar, View, Alert } from 'react-native';
import { useState, useEffect, useMemo } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';

import styles from './styles.js';

// Import all components

import TaskList from './components/TaskList';
import FloatingMenu from './components/FloatingMenu';
import Header from './components/Header';
import Footer from './components/Footer';
import Input from './components/Input';

// Sort tasks

const sortTasks = (list) => {
  const customSorting = (a, b) => {
    // Sort by done / not done
    if (a.done && !b.done) {
      return 1; // 'a' comes after 'b' (done: true at bottom)
    } else if (!a.done && b.done) {
      return -1; // 'a' comes before 'b' (done: false at top)
    }

    // Sort by priority / no priority
    if (a.priority && !b.priority) {
      return -1;
    } else if (!a.priority && b.priority) {
      return 1;
    }

    // Sort by date / no date
    if (a.date && !b.date) {
      0;
      return -1;
    } else if (!a.date && b.date) {
      return 1;
    }

    // Sort by date, if different dates
    if (a.date < b.date) {
      return -1;
    } else if (a.date > b.date) {
      return 1;
    }

    // Sort by time / no time, if same dates
    if (a.time && !b.time) {
      return -1;
    } else if (!a.time && b.time) {
      return 1;
    }

    // Sort by time, if same dates and both have times
    if (a.time < b.time) {
      return -1;
    } else if (a.time > b.time) {
      return 1;
    }

    // None of the conditions above
    return 0;
  };

  return list.sort(customSorting);
};

export default function App() {
  const [tasks, setTasks] = useState([]);
  const [taskText, setTaskText] = useState('');
  const [taskDate, setTaskDate] = useState('');
  const [taskTime, setTaskTime] = useState('');
  const [taskPrio, setTaskPrio] = useState(false);
  const [isMenuVisible, setIsMenuVisible] = useState(false);
  const [heightStatus, setHeightStatus] = useState('small');
  const [showDatePicker, setShowDatePicker] = useState(false);
  const [showTimePicker, setShowTimePicker] = useState(false);

  // Modal-menu

  const openMenu = () => {
    setIsMenuVisible((prevState) => !prevState);
  };

  const closeModal = () => {
    setIsMenuVisible(false);
  };

  const toggleHeight = () => {
    setHeightStatus((prevStatus) => (prevStatus === 'tall' ? 'small' : 'tall'));
  };

  // Getting tasks from device storage

  const loadTasks = async () => {
    try {
      const storedTasks = await AsyncStorage.getItem('tasks');
      if (storedTasks !== null) {
        const list = JSON.parse(storedTasks);
        sortTasks(list);
        saveTasks(list);
        setTasks(list);
      }
    } catch (e) {
      console.error('Failed to fetch tasks from storage', e);
    }
  };

  useEffect(() => {
    loadTasks();
  }, []);

  // Save tasks on device

  const saveTasks = async () => {
    try {
      await AsyncStorage.setItem('tasks', JSON.stringify(tasks));
    } catch (e) {
      console.error('Mislukt om taken op te slaan', e);
    }
  };

  // Add task

  const addTask = () => {
    if (taskText.trim() !== '') {
      const newTasks = [
        ...tasks,
        {
          title: taskText,
          date: formatDate(taskDate),
          time: formatTime(taskTime),
          priority: taskPrio,
          done: false,
        },
      ];
      saveTasks(newTasks);
      setTasks(newTasks);
      setTaskText('');
      setTaskDate('');
      setTaskTime('');
      setTaskPrio(false);
      setShowDatePicker(false);
      setShowTimePicker(false);
    }
  };

  useEffect(() => {
    saveTasks(sortTasks(tasks));
  }, [tasks]);

  useEffect(() => {
    setTasks(sortTasks(tasks));
  }, [tasks]);

  const formatDate = (date) => {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    if (month !== 'NaN') {
      return `${day}-${month}-${year}`;
    }
  };

  const formatTime = (time) => {
    const t = new Date(time);
    const hours = String(t.getHours()).padStart(2, '0');
    const minutes = String(t.getMinutes()).padStart(2, '0');
    if (hours !== 'NaN') {
      return `${hours}:${minutes}`;
    }
  };

  // Task verwijderen

  const deleteTask = (index) => {
    const updatedTasks = tasks.filter((_, i) => i !== index);
    saveTasks(updatedTasks);
    setTasks(updatedTasks);
  };

  const deleteAll = () => {
    Alert.alert(
      'Waarschuwing',
      'Je gaat alles verwijderen. Klopt dat?',
      [
        {
          text: 'Nee',
          style: 'cancel',
        },
        {
          text: 'Ja',
          onPress: () => {
            updatedTasks = [];
            saveTasks(updatedTasks);
            setTasks(updatedTasks);
            closeModal();
          },
        },
      ],
      { cancelable: true }
    );
  };

  const deleteAllDone = () => {
    Alert.alert(
      'Waarschuwing',
      'Je gaat alles verwijderen dat al gedaan is. Klopt dat?',
      [
        {
          text: 'Nee',
          style: 'cancel',
        },
        {
          text: 'Ja',
          onPress: () => {
            const updatedTasks = tasks.filter((task) => !task.done);

            saveTasks(updatedTasks);
            setTasks(updatedTasks);
            closeModal();
          },
        },
      ],
      { cancelable: true }
    );
  };

  // Task set priority

  const togglePrioTask = (index) => {
    const updatedTasks = [...tasks];
    updatedTasks[index].priority = !updatedTasks[index].priority;
    saveTasks(updatedTasks);
    setTasks(updatedTasks);
  };

  const togglePrio = () => {
    setTaskPrio(!taskPrio);
  };

  // Setting date and time

  const showDatePickerHandler = () => {
    setShowDatePicker(true);
  };

  const handleDatePicked = (event, selectedDate) => {
    if (event.type === 'set') {
      setShowDatePicker(false);
      if (selectedDate) {
        setTaskDate(selectedDate);
        setShowTimePicker(true);
      }
    } else {
      setShowDatePicker(false);
    }
  };

  const handleTimePicked = (event, selectedTime) => {
    if (event.type === 'set') {
      setShowTimePicker(false);
      if (selectedTime) {
        setTaskTime(selectedTime);
      }
    } else {
      setShowTimePicker(false);
    }
  };

  // Force update Flatlist

  const sortedTasks = useMemo(() => sortTasks(tasks), [tasks]);

  // Toggle done true/false

  const toggleDoneTask = (index) => {
    const updatedTasks = [...tasks];
    updatedTasks[index].done = !updatedTasks[index].done;
    saveTasks(updatedTasks);
    setTasks(updatedTasks);
  };

  // return ---------------------------------------------------------------------------
  // ----------------------------------------------------------------------------------

  return (
    <View style={styles.container}>
      <StatusBar hidden={true}></StatusBar>

      {/* Header ------------------------------------------------------------------ */}
      <Header openMenu={openMenu} />

      {/* Input ------------------------------------------------------------------- */}
      <Input
        taskText={taskText}
        setTaskText={setTaskText}
        addTask={addTask}
        togglePrio={togglePrio}
        taskPrio={taskPrio}
        taskDate={taskDate}
        taskTime={taskTime}
        showDatePicker={showDatePicker}
        showTimePicker={showTimePicker}
        setShowDatePicker={setShowDatePicker}
        handleDatePicked={handleDatePicked}
        handleTimePicked={handleTimePicked}
      />

      {/* Takenlijst --------------------------------------------------------------- */}
      <TaskList
        tasks={sortedTasks}
        heightStatus={heightStatus}
        toggleDoneTask={toggleDoneTask}
        togglePrioTask={togglePrioTask}
        deleteTask={deleteTask}
      />

      {/* Footer --------------------------------------------------------------- */}
      <Footer />

      {/* Floating Menu */}
      <FloatingMenu
        isVisible={isMenuVisible}
        closeModal={closeModal}
        deleteAll={deleteAll}
        deleteAllDone={deleteAllDone}
        toggleHeight={toggleHeight}
      />
    </View>
  );
}
