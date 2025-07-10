import { getAuth, signOut } from "firebase/auth";
import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

export default function Home() {
    const navigate = useNavigate();
    const auth = getAuth();

    useEffect(() => {
        const isNotSignEnd = auth.onAuthStateChanged((auth) => {
            if (!auth) {
                navigate('/');
            }
        })
        return ()=> isNotSignEnd()
    }, [auth, navigate]);

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
