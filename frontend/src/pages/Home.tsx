import { getAuth, signOut } from "firebase/auth";
import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

export default function Home() {
    const navigate = useNavigate();
    const auth = getAuth();

    useEffect(() => {
        try {
            const isUserSignEnd = auth.onAuthStateChanged((auth) => {
                if (!auth) {
                    navigate('/')
                }
            })
            return () => isUserSignEnd()
        } catch (error) {
            console.log('something is error', error)
        }
    }, [auth, navigate])

    const signOutUser = async () => {
        try {
            await signOut(auth);
            console.log("User signed out");
            navigate('/');
        } catch (error) {
            console.error("Error signing out:", error);
        }
    };

    return (
        <div>
            <button type="button" onClick={signOutUser}>
                Logout
            </button>
        </div>
    );
}
