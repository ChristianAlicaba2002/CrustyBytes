import { useEffect, useState } from "react";
import Navbar from "../components/navbar";
import "../../public/css/about.css";

export default function About() {

    const [isLoading, setIsLoading] = useState<boolean>(false);

    useEffect(() => {
        setTimeout(() => {
            setIsLoading(true);
        }, 1000);
    }, []);


    return (
        <>
            <Navbar />

            {isLoading ? (
                <div className="bg-white mt-10 text-gray-800">
                    <section className="px-6 py-12 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                        <img
                            src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092"
                            alt="About CrustyBytes"
                            className="w-full h-[350px] object-cover rounded-2xl shadow-lg"
                        />
                        <div>
                            <h2 className="text-4xl font-bold text-orange-600 mb-4">About CrustyBytes</h2>
                            <p className="text-lg mb-4">
                                CrustyBytes is more than just a food platform — it’s a celebration of flavor, convenience,
                                and great design. We bring delicious meals to your doorstep with care and speed.
                            </p>
                            <p className="text-gray-600">
                                Whether you're craving comfort food, exploring new dishes, or hosting a family dinner,
                                CrustyBytes makes food delivery fast, smooth, and satisfying.
                            </p>
                        </div>
                    </section>

                    {/* Mission & Vision */}
                    <section className="bg-gray-100 py-12 px-6">
                        <div className="max-w-5xl mx-auto text-center">
                            <h3 className="text-3xl font-bold text-orange-600 mb-6">Our Mission & Vision</h3>
                            <p className="text-lg mb-4">
                                <span className="font-semibold">Mission:</span> To deliver high-quality meals quickly and reliably, while
                                supporting local kitchens and delighting customers with a seamless digital experience.
                            </p>
                            <p className="text-lg">
                                <span className="font-semibold">Vision:</span> To become the go-to food ordering platform known for its
                                simplicity, taste, and community-driven service.
                            </p>
                        </div>
                    </section>

                    {/* Core Values */}
                    <section className="py-12 px-6 max-w-6xl mx-auto">
                        <h3 className="text-3xl font-bold text-orange-600 mb-10 text-center">Our Core Values</h3>
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">
                            <div className="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                                <h4 className="text-xl font-bold mb-2">🍽️ Quality</h4>
                                <p className="text-sm text-gray-600">
                                    Every meal is prepared with fresh ingredients and attention to detail.
                                </p>
                            </div>
                            <div className="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                                <h4 className="text-xl font-bold mb-2">⚡ Speed</h4>
                                <p className="text-sm text-gray-600">
                                    Quick delivery that keeps your food hot and your day moving.
                                </p>
                            </div>
                            <div className="bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                                <h4 className="text-xl font-bold mb-2">🤝 Trust</h4>
                                <p className="text-sm text-gray-600">
                                    Honest service with clear communication and reliable updates.
                                </p>
                            </div>
                        </div>
                    </section>

                    {/* Meet the Team */}
                    <section className="bg-gray-50 py-12 px-6">
                        <div className="max-w-6xl mx-auto text-center">
                            <h3 className="text-3xl font-bold text-orange-600 mb-10">Meet the Team</h3>
                            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                                {[
                                    { name: 'Christian', role: 'Founder & Developer', img: 'https://randomuser.me/api/portraits/men/32.jpg' },
                                    { name: 'Alexa', role: 'Head of Operations', img: 'https://randomuser.me/api/portraits/women/44.jpg' },
                                    { name: 'Jake', role: 'Creative Director', img: 'https://randomuser.me/api/portraits/men/22.jpg' },
                                ].map((member, i) => (
                                    <div key={i} className="bg-white rounded-2xl shadow p-6">
                                        <img
                                            src={member.img}
                                            alt={member.name}
                                            className="w-24 h-24 mx-auto rounded-full mb-4 object-cover"
                                        />
                                        <h4 className="text-lg font-bold">{member.name}</h4>
                                        <p className="text-sm text-gray-600">{member.role}</p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </section>
                </div>

            ) : <div className="flex items-center justify-center min-h-screen bg-amber-50">
                <div className="loader"></div>
            </div>}

        </>
    );
}
