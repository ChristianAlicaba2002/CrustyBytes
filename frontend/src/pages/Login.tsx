import { useState } from 'react';
import { googleProvider, githubProvider } from '../firebase-config.js';
import {
    getAuth,
    signInWithEmailAndPassword,
    signInWithPopup
} from 'firebase/auth';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/navbar.js';

export default function Login() {
    const auth = getAuth();
    const navigate = useNavigate();

    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');
    const [loading, setLoading] = useState<boolean>(false);

    const handleSignIn = async () => {
        if (!email || !password) {
            alert("Please fill in both email and password.");
            return;
        }

        setLoading(true);
        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            const user = userCredential.user;
            console.log("Signed in:", user);
            navigate('/home');
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error("Error:", error.message);
                alert(error.message);
            } else {
                console.error("Unknown error:", error);
            }
        } finally {
            setLoading(false);
        }
    };

    const signInWithGoogle = async () => {
        setLoading(true);
        try {
            const result = await signInWithPopup(auth, googleProvider);
            const user = result.user;
            console.log('User signed in with Google:', user);
            navigate('/home');
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error('Google sign-in error:', error.message);
                alert(error.message);
            } else {
                console.error('Unknown error:', error);
            }
        } finally {
            setLoading(false);
        }
    };

    const signInWithGithub = async () => {
        setLoading(true);
        try {
            const result = await signInWithPopup(auth, githubProvider);
            const user = result.user;
            console.log('User signed in with GitHub:', user);
            navigate('/home');
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error('GitHub sign-in error:', error.message);
                alert(error.message);
            } else {
                console.error('Unknown error:', error);
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            <Navbar />
            <div className="flex items-center justify-center min-h-screen bg-gray-100">
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
                        disabled={loading}
                        className={`bg-orange-400 hover:bg-orange-500 text-white px-4 py-2 cursor-pointer rounded w-full font-semibold mb-4 transition ${loading ? 'opacity-50 cursor-not-allowed' : ''
                            }`}
                    >
                        {loading ? 'Signing In...' : 'Sign In'}
                    </button>
                    <div className="flex items-center my-4">
                        <hr className="flex-grow border-t border-gray-300" />
                        <span className="mx-2 text-gray-400">or</span>
                        <hr className="flex-grow border-t border-gray-300" />
                    </div>
                    <button
                        type="button"
                        onClick={signInWithGoogle}
                        disabled={loading}
                        className="flex items-center justify-center cursor-pointer w-full border border-gray-300 rounded px-4 py-2 mb-1.5 bg-white hover:bg-gray-50 transition"
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
                        onClick={signInWithGithub}
                        disabled={loading}
                        className="flex items-center justify-center cursor-pointer w-full border border-gray-300 rounded px-4 py-2 bg-white hover:bg-gray-50 transition"
                    >
                        <img
                            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"
                            alt="Github"
                            className="w-5 h-5 mr-2"
                        />
                        Sign In with GitHub
                    </button>
                </div>
            </div>
        </>
    );
}
