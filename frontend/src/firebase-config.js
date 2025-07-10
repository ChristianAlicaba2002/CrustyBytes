import { initializeApp } from "firebase/app";
import { getAuth, GoogleAuthProvider, GithubAuthProvider } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyD6oQTcSGnJiDdb9tPZnLXS7n-28jG3pLY",
  authDomain: "crustybytes-7c7b5.firebaseapp.com",
  projectId: "crustybytes-7c7b5",
  storageBucket: "crustybytes-7c7b5.firebasestorage.app",
  messagingSenderId: "1093077775703",
  appId: "1:1093077775703:web:081266f833bed77109ba12",
  measurementId: "G-MHJGZ7JWK3",
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const googleProvider = new GoogleAuthProvider();
const githubProvider = new GithubAuthProvider();

export { app, auth, googleProvider, githubProvider };
export default app;
