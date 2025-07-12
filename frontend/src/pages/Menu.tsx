import { useState, useEffect } from 'react';
import Navbar from '../components/navbar';
import type { TProducts } from '../Types';
import "../../public/css/menu.css"

export default function Menu() {
    const [isLoading, setIsLoading] = useState<boolean>(false);
    const [products, setProducts] = useState<TProducts[]>([]);

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/products");
                const data = await response.json();
                setProducts(data.data);
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        }

        fetchProducts();
    }, []);

    useEffect(() => {
        setTimeout(() => {
            setIsLoading(true);
        }, 1000);
    }, []);
    return (
        <>
            <Navbar />
            {isLoading ? (
                <section className="px-4 py-16 mt-18 bg-orange-50 min-h-screen">
                    <h1 className="text-4xl font-bold text-center text-orange-700 mb-12">Our Products</h1>

                    <div className="space-y-12 max-w-7xl mx-auto">
                        {products.map((item) => {
                            const imageUrl = `http://127.0.0.1:8000/api/storage/${item.image}`;
                            return (
                                <div
                                    key={item.id}
                                    className="flex flex-col md:flex-row items-center gap-6 bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 relative"
                                >
                                    <img
                                        src={imageUrl}
                                        alt={item.name}
                                        className="w-full md:w-60 h-60 object-cover rounded-xl"
                                    />

                                    <div className="flex-1">
                                        {/* Availability Badge */}
                                        {!item.is_available ? (
                                            <span className="absolute top-4 left-4 bg-red-500 text-white text-xs px-3 py-1 rounded-full">
                                                Unavailable
                                            </span>
                                        ) : (
                                            <span className="absolute top-4 left-4 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                                Available
                                            </span>
                                        )}

                                        <h2 className="text-2xl font-bold text-orange-800 mb-2">{item.name}</h2>
                                        <div className="flex flex-wrap gap-3 text-sm text-gray-500 mb-4">
                                            <span>Category: {item.category}</span>
                                            <span>Size: {item.size}</span>
                                        </div>
                                        <p className="text-gray-700 text-base mb-4">{item.description}</p>
                                        <p className="text-orange-600 font-semibold text-xl">&#8369;{item.price}</p>
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                </section>

            ) : <div className="flex items-center justify-center min-h-screen bg-amber-50">
                <div className="loader"></div>
            </div>}

        </>
    );
}
