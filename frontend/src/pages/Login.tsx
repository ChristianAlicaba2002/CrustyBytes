import { useEffect, useState } from 'react';
import { googleProvider, githubProvider } from '../firebase-config.js'
import { getAuth, signInWithEmailAndPassword } from 'firebase/auth';
import { signInWithPopup } from 'firebase/auth';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/navbar.js';

export default function Login() {
    const auth = getAuth()
    const navigate = useNavigate()
    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');

    const handleSignIn = async () => {
        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            const user = userCredential.user;
            console.log("Signed in:", user);
        } catch (error) {
            console.error("Error:", error as string);
        }
    };

    const signInWithGoogle = async () => {
        try {
            const result = await signInWithPopup(auth, googleProvider)
            const user = result.user;
            navigate('/home')
            console.log('User signed in:', user);
        } catch (error) {
            console.error('Error signing in with Google:', error);
        }

    }

    const signinWithGithub = async () => {
        try {
            const result = await signInWithPopup(auth, githubProvider)
            const user = result.user;
            navigate('/home')
            console.log('User signed in:', user);
        } catch (error) {
            console.error('Error signing in with Github:', error);
        }
    }

    return (
        <>
            <Navbar />
            <div className="flex items-center justify-center min-h-screen  bg-gray-100">
                <div className="bg-white shadow-lg rounded-lg p-10 mt-[-5rem] w-full max-w-md">
                    <h2 className="text-2xl font-bold mb-4 text-center text-orange-500">Welcome Back!</h2>
                    <p className="mb-6 text-center text-gray-600">
                        Please sign in to your account to continue ordering your favorite food.
                    </p>
                    <input
                        type="email"
                        placeholder="Email"
                        className="border-none bg-gray-100 p-4 mb-4 w-full rounded focus:outline-none focus:ring-2 focus:ring-orange-400"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                    <input
                        type="password"
                        placeholder="Password"
                        className="border-none bg-gray-100 p-4 mb-4 w-full rounded focus:outline-none focus:ring-2 focus:ring-orange-400"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    <button
                        onClick={handleSignIn}
                        className="bg-orange-400 cursor-pointer hover:bg-orange-500 text-white px-4 py-2 rounded w-full font-semibold mb-4 transition"
                    >
                        Sign In
                    </button>
                    <div className="flex items-center my-4">
                        <hr className="flex-grow border-t border-gray-300" />
                        <span className="mx-2 text-gray-400">or</span>
                        <hr className="flex-grow border-t border-gray-300" />
                    </div>
                    <button
                        type="button"
                        onClick={signInWithGoogle}
                        className="flex cursor-pointer items-center justify-center w-full border border-gray-300 rounded px-4 py-2 mb-1.5 bg-white hover:bg-gray-50 transition"
                    >
                        <img
                            src="https://www.svgrepo.com/show/475656/google-color.svg"
                            alt="Google"
                            className="w-5 h-5 mr-2"
                        />
                        Sign In with Google
                    </button>
                    <button
                        type="button"
                        onClick={signinWithGithub}
                        className="flex cursor-pointer items-center justify-center w-full border border-gray-300 rounded px-4 py-2 bg-white hover:bg-gray-50 transition"
                    >
                        <img
                            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"
                            alt="Github"
                            className="w-5 h-5 mr-2"
                        />
                        Sign In with Github
                    </button>
                </div>
            </div>
        </>
    );
}
