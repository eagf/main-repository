import React, { useState } from 'react';
import { View, TextInput, TouchableOpacity, Image, Text } from 'react-native';
import DateTimePicker from '@react-native-community/datetimepicker';
import styles from '../styles';

const Input = ({ taskText, setTaskText, addTask, togglePrio, taskPrio }) => {
  const [showDatePicker, setShowDatePicker] = useState(false);
  const [showTimePicker, setShowTimePicker] = useState(false);
  const [taskDate, setTaskDate] = useState('');
  const [taskTime, setTaskTime] = useState('');

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

  return (
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
        <TouchableOpacity onPress={() => setShowDatePicker(true)} style={styles.dateTimeButton}>
          <Image
            source={
              taskDate && !taskTime
                ? require('../assets/dateSet.png')
                : taskDate && taskTime
                ? require('../assets/dateTimeSet.png')
                : require('../assets/dateTime.png')
            }
            style={styles.dateTimeImage}
          />
        </TouchableOpacity>
      </View>
      <View style={styles.checkBoxContainer}>
        <TouchableOpacity onPress={togglePrio} style={styles.prioButton}>
          <Image
            source={
              taskPrio == true
                ? require('../assets/starFull.png')
                : require('../assets/starEmpty.png')
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

      {showDatePicker && (
        <DateTimePicker
          testID="datePicker"
          mode="date"
          display="calendar"
          onChange={handleDatePicked}
          value={taskDate ? new Date(taskDate) : new Date()}
        />
      )}
      {showTimePicker && (
        <DateTimePicker
          testID="timePicker"
          mode="time"
          display="clock"
          minuteInterval={5}
          onChange={handleTimePicked}
          value={taskTime ? new Date(taskTime) : new Date()}
          timeZoneName="Europe/Brussels"
          is24Hour
        />
      )}
    </View>
  );
};

export default Input;
