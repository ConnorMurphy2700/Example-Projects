import sys
from PyQt6 import QtWidgets
from PyQt6.QtWidgets import  QMessageBox
from PyQt6.QtGui import QPixmap
from testUI import Ui_MainWindow
from pynput import keyboard
import pandas as pd
import joblib 
import numpy as np
import time
import random
import threading

#mutex lock
lock=threading.Lock()

# load model with joblib
filename = 'RFModel.sav'
classif = joblib.load(filename)

#load dictionary to hold advice 
advice = {0: {1: 'You are doing fine keep going' , 2: 'Your mind is clear ready to work' , 3:'You have a clear mind dont get distracted' },
          1 : {1:'Keep calm and carry on', 2:'You make your best disisions when you are calm' , 3: 'You are the sky. Everything else is just the weather'},
          2 : {1:'Keep up the Positive mental attatude', 2:'Your happiness brightens up the world around you' , 3: 'Happiness is a choice. So keep choosing right'},
          3 : {1:'exhale slowly, releasing all the air from your lungs. Count to 4 and inhale through your nose. Hold a deep breath for 4 seconds, then exhale for another count of 4. Repeat several times', 2:'Anger is temporary. take a step back and it will pass' , 3: 'Holding a grudge is like drinking poison and waiting for the other person to die'},
          4 : {1:'Life has its highs and lows. Without the lows the highs wouldn,t be quite so high. So keep going', 2:'Go for a walk out in the sun it can realy help ' , 3: 'Everything will be OK in the end, if it is not OK, it is not the end.'}}


def on_press(key): #function for keybord listener 
    try:
        hold.kdtemp = int(round(time.time() * 1000))
        print(hold.kdtemp)
        hold.keycode = key.char
    except AttributeError:
        print('special key {0} pressed'.format(key))
        hold.check = 1

        

def on_release(key): #function for keybord listener 
        if(hold.check != 1):
            hold.kutemp = int(round(time.time() * 1000))
            print(hold.kutemp)
            print(hold.keycode)
            lock.acquire()
            UpdateKeyData(hold.kutemp, hold.kdtemp)
            lock.release()
        else:
            hold.check=0


def UpdateKeyData(keyUp, keyDown): #function for updating keyboard data
    hold.kd1 = hold.kd2 
    hold.ku1 = hold.ku2
    hold.kd2 = hold.kd3 
    hold.ku2 = hold.ku3 
    hold.kd3 = keyDown
    hold.ku3 = keyUp  
    print(hold.kd1, hold.ku1, hold.kd2, hold.ku2, hold.kd3, hold.ku3, hold.keycode)

def CalculateImput():
    hold.D1U1 = hold.ku1 - hold.kd1
    hold.D1U2 = hold.ku2 - hold.kd1
    hold.D1D2 = hold.kd2 - hold.kd1 
    hold.U1D2 = hold.kd2 - hold.ku1
    hold.U1U2 = hold.ku2 - hold.ku1
    hold.D1U3 = hold.ku3 - hold.kd1
    hold.D1D3 = hold.kd3 - hold.kd1
    print(hold.D1U1, hold.D1U2, hold.D1D2, hold.U1D2, hold.U1U2, hold.D1U3, hold.D1D3)


class Variables:
    showimg = 1
    kd1 = 0
    ku1 = 0
    kd2 = 0
    ku2 = 0
    kd3 = 0
    ku3 = 0
    kutemp = 0
    kdtemp = 0
    keycode = ' '
    D1U1 = 0
    D1U2 = 0
    D1D2 = 0
    U1D2 = 0
    U1U2 = 0
    D1U3 = 0
    D1D3 = 0
    check = 0




class MainWindow(QtWidgets.QMainWindow, Ui_MainWindow):
    def __init__(self, *args, obj=None, **kwargs): # loads the GUI for the application 
        super(MainWindow, self).__init__()
        self.ui = Ui_MainWindow()
        self.ui.setupUi(self)
        self.ui.EstimateButton.clicked.connect(self.displayResult)
        self.ui.ClearText.clicked.connect(self.ClearInput)
        self.ui.newindow.clicked.connect(self.TestImage)

    def TestImage (self, checked): #function for view image button 
        self.dialog = QtWidgets.QDialog()
        self.dialog.setGeometry(15, 15, 300, 300)
        lay = QtWidgets.QVBoxLayout(self.dialog)
        label = QtWidgets.QLabel()
        lay.addWidget(label)
        pixmap = QPixmap( str(hold.showimg) + ".jpg")
        hold.showimg = hold.showimg + 1
        label.setPixmap(pixmap)
        self.dialog.show()
        
        if hold.showimg==6: # resets counter used to display images 
            hold.showimg = 1




    def displayResult(self, s): # function for estimate mood button 
        lock.acquire()
        CalculateImput() 
        keycode = ord( hold.keycode)
        lock.release()
        # predict result 
        testa = np.array([keycode, 1, 1, hold.D1U1, hold.D1U2, hold.D1D2, hold.U1D2, hold.U1U2, hold.D1U3, hold.D1D3]).reshape(1, -1)#0
        Test1 = classif.predict(testa)

        a = str(Test1)
        a = int(a[1])
        # N = 0 C = 1 H = 2 A = 3 S = 4  
        if a == 0:
            feeling = 'Neutral'
        elif a == 1:
            feeling = 'Calm'
        elif a == 2:
            feeling = 'Happy'
        elif a ==3:
            feeling = 'Angry'
        else:
            feeling = 'Sad'

        r = random.randrange(1,4)
        dlg = QMessageBox(self)
        dlg.setWindowTitle("Your Mood is")
        dlg.setText("right now you are feeling " + feeling)
        dlg.setInformativeText(advice[a][r])
        dlg.exec()


    def ClearInput (self, s): # function for clear text button 
        self.ui.TextImputbox.clear()


app = QtWidgets.QApplication(sys.argv)
listener = keyboard.Listener( #used for monitoring the keyboard 
    on_press=on_press,
    on_release=on_release)
listener.start()
hold = Variables()
window = MainWindow()
window.show()
app.exec()