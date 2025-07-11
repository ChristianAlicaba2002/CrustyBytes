import { getAuth, signOut } from "firebase/auth";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import type { TUser } from "../Types";

export default function Home() {
    const navigate = useNavigate();
    const auth = getAuth();
    const [user, setUser] = useState<TUser>({
        uId: "",
        name: "",
        email: "",
        password: "",
    })

    useEffect(() => {
        try {
            const isUserSignEnd = auth.onAuthStateChanged((userAuth) => {
                if (!userAuth) {
                    navigate('/')
                }

                setUser((prev) => ({
                    ...prev,
                    uId: userAuth?.uid || "",
                    name: userAuth?.displayName || "",
                    email: userAuth?.email || "",
                    password: "",

                }))
            })
            return () => isUserSignEnd()
        } catch (error) {
            console.log('something is error', error)
        }
    }, [auth, navigate])


    useEffect(() => {
        const postUserData = async () => {
            try {
                const response = await fetch("http://localhost:8000/api/users", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({...user})
                });

                const dataUser = await response.json()
                if (dataUser) {
                    console.log(dataUser)
                }
            } catch (error) {
                console.error(error)
            }
        }
        postUserData()
    }, [user])



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
