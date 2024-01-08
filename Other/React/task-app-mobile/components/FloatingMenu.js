// FloatingMenu.js
import React from 'react';
import { Modal, TouchableOpacity, TouchableWithoutFeedback, Text, View } from 'react-native';
import styles from '../styles.js';

const FloatingMenu = ({ isVisible, closeModal, deleteAll, deleteAllDone, toggleHeight }) => {
  return (
    <Modal animationType="slide" transparent={true} visible={isVisible} onRequestClose={closeModal}>
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
  );
};

export default FloatingMenu;
