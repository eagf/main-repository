import { StatusBar, TextInput, FlatList, Text, View, StyleSheet, TouchableOpacity, Alert, Image, Modal, TouchableWithoutFeedback } from 'react-native';
import React, { useState, useEffect, useMemo } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { FontAwesome } from '@expo/vector-icons';
import DateTimePicker from '@react-native-community/datetimepicker';

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
      0
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
  const [showDatePicker, setShowDatePicker] = useState(false);
  const [showTimePicker, setShowTimePicker] = useState(false);
  const [isMenuVisible, setIsMenuVisible] = useState(false);
  const [heightStatus, setHeightStatus] = useState('small');

  // Modal-menu

  const openMenu = () => {
    setIsMenuVisible(prevState => !prevState);
  };

  const closeModal = () => {
    setIsMenuVisible(false);
  };

  const toggleHeight = () => {
    setHeightStatus(prevStatus => (prevStatus === "tall" ? "small" : "tall"));
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
      console.error('Failed to save tasks to storage', e);
    }
  };

  // Add task

  const addTask = () => {
    if (taskText.trim() !== '') {
      const newTasks = [...tasks, { title: taskText, date: formatDate(taskDate), time: formatTime(taskTime), priority: taskPrio, done: false }];
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
            const updatedTasks = tasks.filter(task => !task.done);

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

  const showDatePickerHandler = () => {
    setShowDatePicker(true);
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

  // Aparte Taskitems ----------------------------

  const renderTaskItem = ({ item, index }) => (
    <View style={[styles.taskItem, { paddingVertical: heightStatus === 'tall' ? 10 : 0 }]}>
      <View style={styles.titleDateTimeContainer}>
        <TouchableOpacity onPress={() => toggleDoneTask(index)}>
          <View>
            <Text style={item.done ? styles.titleDone : styles.title} onPress={() => toggleDoneTask(index)}>
              {item.title}
            </Text>
          </View>
        </TouchableOpacity>
        <View style={styles.dateTime}>
          {item.date && <Text style={styles.date}>{item.date} </Text>}
          {item.time && <Text style={styles.time}>{item.time}</Text>}
        </View>
      </View>
      <View style={styles.taskItemButtonsContainer}>
        <TouchableOpacity onPress={() => togglePrioTask(index)} style={styles.prioTaskButton}>
          <Image
            source={
              item.priority == true ? (
                require('./assets/starFull.png')
              ) : (
                require('./assets/starEmpty.png')
              )
            }
            style={[styles.prioTaskButtonImage, { height: heightStatus === 'tall' ? 30 : 20, width: heightStatus === 'tall' ? 30 : 20,}]}
          />
        </TouchableOpacity>
        <TouchableOpacity onPress={() => deleteTask(index)} style={styles.deleteButton}>
          <FontAwesome name="times-circle" size={heightStatus === 'tall' ? 25 : 20} color="red" />
        </TouchableOpacity>
      </View>
    </View>
  );

  // return ---------------------------------------------------------------------------
  // ----------------------------------------------------------------------------------

  return (
    <View style={styles.container}>

      {/* Header ------------------------------------------------------------------ */}
      <View style={styles.headerContainer}>
        <Text style={styles.titleApp}>Taken</Text>
      </View>


      {/* Input ------------------------------------------------------------------- */}
      <View style={styles.inputContainer}>
        <View style={styles.taskTitleContainer}>
          <TextInput
            style={styles.input}
            placeholder="Taaknaam"
            value={taskText}
            onChangeText={setTaskText}
            onSubmitEditing={addTask}
          />
        </View>
        <View style={styles.taskDateTimeContainer}>
          <TouchableOpacity onPress={showDatePickerHandler} style={styles.dateTimeButton}>
            <Image
              source={
                (taskDate && !taskTime) ? (
                  require('./assets/dateSet.png')
                ) : (taskDate && taskTime) ? (
                  require('./assets/dateTimeSet.png')
                ) : (
                  require('./assets/dateTime.png')
                )
              }
              style={styles.dateTimeImage}
            />
          </TouchableOpacity>
        </View>
        <View style={styles.checkBoxContainer}>
          <TouchableOpacity onPress={() => togglePrio()} style={styles.prioButton}>
            <Image
              source={
                taskPrio == true ? (
                  require('./assets/starFull.png')
                ) : (
                  require('./assets/starEmpty.png')
                )
              }
              style={styles.prioImage}
            />
          </TouchableOpacity>
        </View>
        <View style={styles.addTaskButtonContainer}>
          <TouchableOpacity onPress={addTask} style={styles.addTaskButton}>
            <Text style={styles.addTaskButtonText}>Voeg toe</Text>
          </TouchableOpacity>
        </View>
      </View>

      {/* Takenlijst --------------------------------------------------------------- */}
      <View style={styles.tasksContainer}>
        {tasks.length > 0 ? (
          <FlatList
            data={sortedTasks}
            renderItem={renderTaskItem}
            keyExtractor={(item, index) => index.toString()}
          />
        ) : (
          <Text>Geen taken in het systeem</Text>
        )}
      </View>

      {/* Footer --------------------------------------------------------------- */}
      {/* <View style={styles.footerContainer}>

      </View> */}

      {/* Floating Menu Button -------------------------------------------------------------- */}
      <TouchableOpacity onPress={openMenu} style={styles.modalOpenButton}>
        <FontAwesome name="gear" size={24} color="white" />
      </TouchableOpacity>

      {/* Floating Menu */}
      <Modal
        animationType="slide"
        transparent={true}
        visible={isMenuVisible}
        onRequestClose={closeModal}
      >
        <TouchableWithoutFeedback onPress={closeModal}>
          <View style={styles.modalContainer}>
            <View style={styles.modalContent}>
              <TouchableOpacity onPress={deleteAll} style={styles.menuButton}>
                <Text style={styles.menuButtonText}>Verwijder alles</Text>
              </TouchableOpacity>
              <TouchableOpacity onPress={deleteAllDone} style={styles.menuButton}>
                <Text style={styles.menuButtonText}>Verwijder voltooide</Text>
              </TouchableOpacity>
              <TouchableOpacity onPress={toggleHeight} style={styles.menuButton}>
                <Text style={styles.menuButtonText}>Verander hoogte</Text>
              </TouchableOpacity>
            </View>
          </View>
        </TouchableWithoutFeedback>
      </Modal>

      {/* Overige elementen  -------------------------------------------------------------- */}
      {showDatePicker && (
        <DateTimePicker
          testID="datePicker"
          mode="date"
          display='calendar'
          onChange={handleDatePicked}
          value={taskDate ? new Date(taskDate) : new Date()}
        />
      )}
      {showTimePicker && (
        <DateTimePicker
          testID="timePicker"
          mode="time"
          display='clock'
          minuteInterval={5}
          onChange={handleTimePicked}
          value={taskTime ? new Date(taskTime) : new Date()}
          timeZoneName="Europe/Brussels"
          is24Hour
        />
      )}
      <StatusBar style="auto" />

    </View>

  );
}

// Stylesheet ---------------------------------------------------------------------------
// --------------------------------------------------------------------------------------

const styles = StyleSheet.create({

  container: {
    display: 'flex',
    flex: 1,
    marginBottom: 10,
    height: '100%',
    width: '100%',
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
    flexDirection: 'column',
  },

  // Header ------------------------------------------------------------------------------

  headerContainer: {
    backgroundColor: '#4CAF50',
    width: '100%',
    paddingVertical: 15,
    paddingHorizontal: 40,
  },
  titleApp: {
    fontSize: 40,
    fontWeight: 'bold',
    color: '#fff',
    textTransform: 'uppercase',
    textAlign: 'center',
  },

  // Input -------------------------------------------------------------------------------

  inputContainer: {
    display: 'flex',
    flex: 0.8,
    width: '100%',
    flexDirection: 'row',
    alignItems: 'center',
  },

  // Task title input

  taskTitleContainer: {
    flex: 2,
    paddingLeft: 20,
    paddingRight: 10,
  },

  input: {
    height: 30,
    borderColor: 'gray',
    borderWidth: 0.5,
    marginBottom: 10,
    paddingHorizontal: 10,
  },

  // Date Time button

  taskDateTimeContainer: {
    flex: 0.3,
    paddingLeft: 10,
    paddingRight: 10,
    paddingBottom: 4,

  },
  dateTimeButton: {

  },
  dateTimeImage: {
    width: 30,
    height: 30,
  },

  // Priority icon

  checkBoxContainer: {
    flex: 0.3,
    paddingLeft: 10,
    paddingRight: 10,
    paddingBottom: 4,
  },
  prioButton: {

  },
  prioImage: {
    width: 30,
    height: 30,
  },

  // Add task button 

  addTaskButtonContainer: {
    flex: 1,
    paddingLeft: 10,
    paddingRight: 20,
  },

  addTaskButton: {
    backgroundColor: '#4CAF50',
    padding: 10,
    borderRadius: 5,
    alignItems: 'center',
  },
  addTaskButtonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },

  // Tasks ------------------------------------------------------------------------------------

  tasksContainer: {
    display: 'flex',
    flexDirection: 'column',
    flex: 5,
  },

  taskItem: {
    flex: 1,
    flexDirection: 'row',
    width: 350,
    borderBottomWidth: 1,
    borderBottomColor: '#ddd',
    paddingVertical: 10,
    paddingHorizontal: 20,
    justifyContent: 'space-between',
  },

  titleDateTimeContainer: {
    flexDirection: 'column',
  },

  title: {
    flex: 1,
    fontSize: 20,
    fontWeight: 'bold',
    textDecorationLine: 'none',
    maxWidth: 240,
  },
  titleDone: {
    marginRight: 20,
    fontSize: 20,
    textDecorationLine: 'line-through',
    maxWidth: 240,
  },
  dateTime: {
    flexDirection: 'row',
    fontSize: 16,
    color: '#666',
  },

  taskItemButtonsContainer: {
    flexDirection: 'row',
    alignItems: 'center',
  },

  prioTaskButton: {
    alignSelf: 'center',
    marginRight: 15,
  },
  prioTaskButtonImage: {
    width: 30,
    height: 30,
  },
  deleteButton: {

  },

  // Footer ------------------------------------------------------------------------------------

  // footerContainer: {

  // },

  // Menu and menuoptions -----------------------------------------------------------------------

  modalOpenButton: {
    position: 'absolute',
    bottom: 20,
    left: 20,
    backgroundColor: 'rgba(0, 0, 255, 0.8)',
    padding: 10,
    borderRadius: 5,
  },
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'rgba(0, 0, 0, 0.3)',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5, // (Only Android)
    alignItems: 'center',
  },
  menuButton: {
    width: 250,
    fontSize: 18,
    paddingVertical: 10,
    backgroundColor: 'grey',
    padding: 10,
    margin: 10,
    borderRadius: 5,
    alignItems: 'center',
    justifyContent: 'center',
  },
  menuButtonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
    textShadowColor: 'black',
    textShadowOffset: { width: 1, height: 1 },
    textShadowRadius: 3,
  },

})
