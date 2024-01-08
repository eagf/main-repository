// TaskList.js
import { FlatList, Text, View } from 'react-native';
import TaskItem from '../components/TaskItem';
import styles from '../styles.js';

const TaskList = ({ tasks, heightStatus, toggleDoneTask, togglePrioTask, deleteTask }) => (
  <View style={styles.tasksContainer}>
    {tasks.length > 0 ? (
      <FlatList
        data={tasks}
        renderItem={({ item, index }) => (
          <TaskItem
            item={item}
            index={index}
            heightStatus={heightStatus}
            toggleDoneTask={toggleDoneTask}
            togglePrioTask={togglePrioTask}
            deleteTask={deleteTask}
          />
        )}
        keyExtractor={(item, index) => index.toString()}
      />
    ) : (
      <Text>Geen taken in het systeem</Text>
    )}
  </View>
);

export default TaskList;
