// Header.js
import React from 'react';
import { View, Text, TouchableOpacity } from 'react-native';
import { FontAwesome } from '@expo/vector-icons';
import styles from '../styles.js';

const Header = ({ openMenu }) => {
  return (
    <View style={styles.headerContainer}>
      <TouchableOpacity onPress={openMenu} style={styles.modalOpenButton}>
        <FontAwesome name="bars" size={38} color="white" />
      </TouchableOpacity>
      <Text style={styles.titleApp}>Taken</Text>
    </View>
  );
};

export default Header;
