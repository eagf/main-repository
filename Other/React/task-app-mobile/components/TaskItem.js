// TaskItem.js
import { View, Text, TouchableOpacity, Image } from 'react-native';
import { FontAwesome } from '@expo/vector-icons';
import styles from '../styles.js';

const TaskItem = ({ item, index, heightStatus, toggleDoneTask, togglePrioTask, deleteTask }) => (
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
            item.priority == true
              ? require('../assets/starFull.png')
              : require('../assets/starEmpty.png')
          }
          style={[
            styles.prioTaskButtonImage,
            {
              height: heightStatus === 'tall' ? 30 : 20,
              width: heightStatus === 'tall' ? 30 : 20,
            },
          ]}
        />
      </TouchableOpacity>
      <TouchableOpacity onPress={() => deleteTask(index)} style={styles.deleteButton}>
        <FontAwesome
          name="times-circle"
          size={heightStatus === 'tall' ? 25 : 20}
          color="red"
        />
      </TouchableOpacity>
    </View>
  </View>
);

export default TaskItem;
