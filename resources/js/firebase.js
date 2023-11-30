// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAehxQi2ll_DDEcheQTpXFVlj8FXHTHsKE",
  authDomain: "test-chat-71d55.firebaseapp.com",
  databaseURL: "https://test-chat-71d55-default-rtdb.firebaseio.com",
  projectId: "test-chat-71d55",
  storageBucket: "test-chat-71d55.appspot.com",
  messagingSenderId: "219141915987",
  appId: "1:219141915987:web:d8325073970c0f30d7cda6",
  measurementId: "G-RRXEL7F27D"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);