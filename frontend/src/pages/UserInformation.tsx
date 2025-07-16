import { getAuth } from "firebase/auth";
import type { TUser } from "../Types";
import { useEffect, useState } from "react";
import { CiEdit } from "react-icons/ci";

export default function UserInformation() {
    const auth = getAuth();
    const [user, setUser] = useState<TUser | null>(null);
    const [userInfo, setUserInfo] = useState<TUser | null>(null);
    const [isLoading, setIsLoading] = useState<boolean>(false)
    const [contactForm, setContactForm] = useState<boolean>(false)
    const [userData, setUserData] = useState<TUser>({
        uId: "",
        name: "",
        phone_number: "",
        city: "",
        barangay: "",
        purok: "",
        email: "",
        password: "",
        image: "",
    })

    //Get the User Details
    useEffect(() => {
        const userAuth = auth.onAuthStateChanged((authUser) => {
            if (authUser) {
                setUser({
                    uId: authUser.uid || "",
                    name: authUser.displayName || "User Guest",
                    phone_number: "",
                    city: "",
                    barangay: "",
                    purok: "",
                    email: authUser.email || 'No email provided',
                    password: "No password provided",
                    image: authUser.photoURL || "https://via.placeholder.com/150",
                });
            } else {
                setUser(null);
            }
        });

        return () => userAuth();
    }, [auth]);

    //Get the User Information from backend
    useEffect(() => {
        const getUserData = async () => {
            try {
                const response = await fetch(`http://localhost:8000/api/users/${user?.uId}`)

                if (!response.ok) {
                    throw new Error(`Error Found ${response.status}`)
                }

                const data = await response.json()
                if (data) {
                    console.log(data.data)
                    setUserInfo(data.data)
                }

            } catch (error) {
                console.error(error)
            }

        }

        getUserData()
    }, [user])

    //Check if there is no user logged in
    if (!user) {
        return (
            <div className="p-4 bg-gray-100 rounded-lg shadow-md">
                <p className="text-gray-600">No user is currently signed in.</p>
            </div>
        );
    }

    //Handle submit form
    const submitForm = async (e: React.FormEvent) => {
        e.preventDefault()
        setIsLoading(true)

        const submitUserForm = {
            phone_number: userData.phone_number,
            city: userData.city,
            barangay: userData.barangay,
            purok: userData.purok,
        }

        try {
            const response = await fetch(`http://localhost:8000/api/users/${user.uId}`, {
                method: "PUT",
                headers: {
                    "Authorization": `Bearer ${user.uId}`,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(submitUserForm)
            })
            if (!response.ok) {
                throw new Error(`Status Found: ${response.status}`)
            }

            window.location.reload()

        } catch (error) {
            console.log(error)
        }
        finally {
            setIsLoading(false)
        }
    }

    //Handle change input element 
    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;
        setUserData((prev) => ({
            ...prev,
            [name]: value
        }));
    };

    return (
        <div className="w-full mx-auto bg-white rounded-lg shadow-xl overflow-hidden m-4">
            <div className="md:flex">
                {/* Profile Image Section */}
                {user.image && (
                    <div className="md:w-1/3 bg-gradient-to-b from-blue-50 to-gray-100 flex flex-col items-center justify-center p-8">
                        <img
                            className="h-72 w-72 rounded-full object-cover border-4 border-white shadow-lg"
                            src={user.image}
                            alt={`${user.name}'s profile`}
                        />
                        <div className="mt-6 text-center">
                            <h3 className="text-xl font-semibold text-gray-800">{user.name || "User"}</h3>
                            <p className="text-gray-500 mt-1">{user.email || "No email provided"}</p>
                        </div>
                    </div>
                )}

                {/* User Information Section */}
                <div className="md:w-2/3 p-8">
                    <div className="mb-8">
                        <h2 className="text-3xl font-bold text-gray-800">User Profile Dashboard</h2>
                        <p className="text-gray-600 mt-2">
                            Welcome to your personal profile page. Here you can view and update your account information.
                            Please ensure your details are current for better service experience.
                        </p>
                    </div>

                    {/* Basic Info Section */}
                    <div className="mb-10">
                        <h3 className="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Account Information
                            <div className="edit flex justify-end -mt-4">
                                <CiEdit className="text-2xl cursor-pointer" onClick={() => setContactForm((prev) => !prev)} />
                            </div>
                        </h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <div className="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    {user.name || "Not provided"}
                                </div>
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <div className="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    {user.email || "Not provided"}
                                </div>
                            </div>
                            {userInfo ? (
                                <div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">Phone number</label>
                                        <div className="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            {userInfo.phone_number || "Not provided"}
                                        </div>
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <div className="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            {userInfo.purok}, {userInfo.barangay} , {userInfo.city}
                                        </div>
                                    </div>
                                </div>
                            ) : (
                                <div>Loading user information...</div>
                            )}

                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">User ID</label>
                                <div className="p-3 bg-gray-50 rounded-lg border border-gray-200 text-xs break-all">
                                    {user.uId}
                                </div>
                                <p className="text-xs text-gray-500 mt-1">
                                    Your unique identifier in our system. Keep this confidential.
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Additional Information Form */}
                    {contactForm &&
                        <form onSubmit={submitForm} className="space-y-6">
                            <div>
                                <h3 className="text-xl font-semibold text-gray-800 border-b pb-2">Contact Information</h3>
                                <p className="text-gray-600 mt-2 mb-4">
                                    Please provide your complete contact details. This information helps us serve you better and
                                    ensure accurate delivery of services to your location.
                                </p>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label htmlFor="phone_number" className="block text-sm font-medium text-gray-700 mb-1">
                                        Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone_number"
                                        name="phone_number"
                                        maxLength={11}
                                        value={userData.phone_number}
                                        className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="+63 912 345 6789"
                                        onChange={handleChange}
                                    />
                                    <p className="text-xs text-gray-500 mt-1">
                                        Include country code. We'll use this for important notifications.
                                    </p>
                                </div>

                                <div>
                                    <label htmlFor="city" className="block text-sm font-medium text-gray-700 mb-1">
                                        City/Municipality
                                    </label>
                                    <input
                                        type="text"
                                        id="city"
                                        name="city"
                                        value={userData.city}
                                        className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="e.g. Cebu City"
                                        onChange={handleChange}
                                    />
                                </div>

                                <div>
                                    <label htmlFor="barangay" className="block text-sm font-medium text-gray-700 mb-1">
                                        Barangay
                                    </label>
                                    <input
                                        type="text"
                                        id="barangay"
                                        name="barangay"
                                        value={userData.barangay}
                                        className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="e.g. Talamban"
                                        onChange={handleChange}
                                    />
                                </div>

                                <div>
                                    <label htmlFor="purok" className="block text-sm font-medium text-gray-700 mb-1">
                                        Purok/Zone
                                    </label>
                                    <input
                                        type="text"
                                        id="purok"
                                        name="purok"
                                        value={userData.purok}
                                        className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="e.g. Purok 3"
                                        onChange={handleChange}
                                    />
                                    <p className="text-xs text-gray-500 mt-1">
                                        Specify your zone or purok number for precise location.
                                    </p>
                                </div>
                            </div>


                            <div className="flex justify-between items-center pt-6 border-t">
                                <p className="text-sm text-gray-500">
                                    Last updated: {new Date().toLocaleDateString()}
                                </p>
                                <div className="space-x-3">
                                    <button
                                        type="button"
                                        className="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        className="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition duration-200 shadow-sm"
                                    >
                                        {isLoading ? "Saving Changes..." : "Save Changes"}
                                    </button>
                                </div>
                            </div>
                        </form>
                    }
                </div>
            </div>
        </div>
    );
}