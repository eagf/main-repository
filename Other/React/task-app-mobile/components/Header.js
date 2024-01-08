// Header.js
import React from 'react';
import { View, Text, TouchableOpacity, Image } from 'react-native';
import { FontAwesome } from '@expo/vector-icons';
import styles from '../styles.js';

const Header = ({ openMenu }) => {
  return (
    <View style={styles.headerContainer}>
      <Image style={styles.titleApp} source={require('../assets/tasks.png')}/>
      <TouchableOpacity onPress={openMenu} style={styles.modalOpenButton}>
        <FontAwesome name="bars" size={38} color="white" />
      </TouchableOpacity>
    </View>
  );
};

export default Header;
