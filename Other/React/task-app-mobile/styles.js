import { StyleSheet } from 'react-native';

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
    display: 'flex',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    backgroundColor: '#4CAF50',
    width: '100%',
    paddingVertical: 10,
    paddingRight: 20,
    paddingLeft: 10,
  },
  titleApp: {
    height: 50,
    width: 240,
    resizeMode: 'center',
  },
  modalOpenButton: {
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
  dateTimeButton: {},
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
  prioButton: {},
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
  deleteButton: {},

  // Footer ------------------------------------------------------------------------------------

  footerContainer: {},
  footerText: {
    color: '#333',
    fontSize: 16,
    fontWeight: 'bold',
  },

  // Menu and menuoptions -----------------------------------------------------------------------

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
});

export default styles;
