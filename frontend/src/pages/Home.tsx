import { getAuth, signOut } from "firebase/auth";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import type { TUser } from "../Types";
import type { TProducts } from "../Types";
import type { TCartItem } from "../Types";
import { FaShoppingCart, FaSearch } from 'react-icons/fa';
import { PiSignOutBold } from "react-icons/pi";
import { GrAdd } from "react-icons/gr";
import { MdHistory } from "react-icons/md";
import UserLogo from "../assets/images/person.webp";

export default function Home() {
    const navigate = useNavigate();
    const auth = getAuth();
    const [user, setUser] = useState<TUser>({
        uId: "",
        name: "",
        email: "",
        password: "",
        image: ""
    })
    const [products, setProducts] = useState<TProducts[]>([])
    const [search, setSearch] = useState('');
    const [isCartOpen, setIsCartOpen] = useState(false);
    const [itemInCart, setItemInCart] = useState<TCartItem[] | null>([])
    const [selectedItems, setSelectedItems] = useState<string[]>([]);
    const [totalPrice, setTotalPrice] = useState<number>(0);


    //Search the product
    const filteredProducts = products.filter((product: TProducts) =>
        product.name.toLowerCase().includes(search.toLowerCase())
    );

    //Check if the user if sign end if not redirect into the welcome page
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
                    image: userAuth?.photoURL || ""

                }))
            })
            return () => isUserSignEnd()
        } catch (error) {
            console.log('something is error', error)
        }
    }, [auth, navigate])

    //Passing the user data in the BACKEND
    useEffect(() => {
        const postUserData = async () => {
            try {
                const response = await fetch("http://localhost:8000/api/users", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ ...user })
                });
                if (!response.ok) {
                    console.log(response.status)
                }
            } catch (error) {
                console.error(error)
            }
        }
        postUserData()
    }, [user])

    //Sign out button
    const signOutUser = async () => {
        try {
            await signOut(auth);
            navigate('/');
        } catch (error) {
            console.error("Error signing out:", error);
        }
    };

    //Fetch the all products
    useEffect(() => {
        const fetchTheProducts = async () => {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/products");
                if (!response.ok) return 1;
                const item = await response.json()
                if (item) {

                    setProducts(item.data)
                }
            } catch (error) {
                console.error(error)
            }
        }
        fetchTheProducts()
    }, [])

    // Add To Cart Toggle
    const addToCartItem = (item: TProducts) => {
        let quantity = 0
        const existingCart = JSON.parse(localStorage.getItem('item') || '[]')

        const pushToCart = {
            id: item.id,
            uId: user.uId,
            username: user.name,
            image: item.image,
            name: item.name,
            quantity: quantity += 1,
            category: item.category,
            size: item.size,
            price: item.price
        }

        // Check if item already exists in cart
        const existingIndex = existingCart.find((cartItem: TCartItem) => cartItem.id === item.id);

        if (existingIndex) {
            existingIndex.quantity += 1;
            localStorage.setItem('item', JSON.stringify(existingCart));

            // Filter the item if the item in the cart of user is equal on the user who signend 
            const userCartItems = existingCart.filter((cartItem: TCartItem) => cartItem.uId === user.uId);

            // Update the Item in cart
            setItemInCart(userCartItems);

            return;
        }

        existingCart.push(pushToCart)

        // Update the localStorage
        localStorage.setItem('item', JSON.stringify(existingCart))

        const userCartItems = existingCart.filter((cartItem: TCartItem) => cartItem.uId === user.uId);
        setItemInCart(userCartItems);
    }

    //Get the item of the user from localstorage
    useEffect(() => {
        try {
            const getItemInCart = JSON.parse(localStorage.getItem('item') || '[]');

            // Filter cart items for the current user
            const userCartItems = getItemInCart.filter((item: TCartItem) => item.uId === user.uId);

            // Update the Item in cart
            setItemInCart(userCartItems);

        } catch (error) {
            console.error(error)
        }
    }, [user.uId])


    //Remove Item cart handle
    const removeInCart = (item: TCartItem) => {
        const getItemInCart = JSON.parse(localStorage.getItem('item') || '[]');

        // Remove only the item for the current user and matching id
        const removeItem = getItemInCart.filter(
            (itemInCart: TCartItem) => !(itemInCart.id === item.id && itemInCart.uId === user.uId)
        );
        //Update the localstorage
        localStorage.setItem('item', JSON.stringify(removeItem));

        //Update also teh Item in cart
        setItemInCart(removeItem.filter((item: TCartItem) => item.uId === user.uId));
    }


    //decreased the quantity
    const minusQuantity = (item: TCartItem) => {
        const cart = JSON.parse(localStorage.getItem('item') || '[]');
        const ItemQuantity = cart.find(
            (cartItem: TCartItem) => cartItem.id === item.id && cartItem.uId === item.uId
        );

        if (ItemQuantity && ItemQuantity.quantity > 1) {
            ItemQuantity.quantity -= 1;
            localStorage.setItem('item', JSON.stringify(cart));
            setItemInCart(cart.filter((cartItem: TCartItem) => cartItem.uId === user.uId));
        }
    }

    //Increased the quantity
    const addQuantity = (item: TCartItem) => {
        const cart = JSON.parse(localStorage.getItem('item') || '[]');

        const foundItem = cart.find(
            (cartItem: TCartItem) =>
                cartItem.id === item.id && cartItem.uId === item.uId
        );

        if (foundItem) {
            foundItem.quantity += 1;
            localStorage.setItem('item', JSON.stringify(cart));

            const updatedCart = cart.filter(
                (cartItem: TCartItem) => cartItem.uId === user.uId
            );

            setItemInCart(updatedCart);

            // Calculate the new total from updatedCart
            const total = updatedCart
                .filter((cartItem:TCartItem) => selectedItems.includes(String(cartItem.id)))
                .reduce((sum:number, cartItem:TCartItem) => sum + cartItem.price * cartItem.quantity, 0);

            setTotalPrice(total);
        }
    };


    const checkboxTheItem = (item: TCartItem) => {
        const itemIdStr = String(item.id);
        setSelectedItems((prev) => {
            if (prev.includes(itemIdStr)) {
                // Uncheck: remove from selected
                return prev.filter(id => id !== itemIdStr);
            } else {
                // Check: add to selected
                return [...prev, itemIdStr];
            }
        });
    };

    // Check/Uncheck all items in cart
    const checkAllItem = (cartItems: TCartItem[] | null) => {
        if (!cartItems) return;

        if (selectedItems.length === cartItems.length) {
            setSelectedItems([]);
            setTotalPrice(0);
        } else {
            const selected = cartItems.map(item => String(item.id));
            setSelectedItems(selected);

            const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
            setTotalPrice(total);
        }
    };

    // Update checkout to use selected items if any
    const checkOutPreview = (id: string) => {
        // If any items are selected, only checkout those; otherwise, all
        const itemsToCheckout = selectedItems.length > 0
            ? itemInCart?.filter(item => selectedItems.includes(String(item.id)))
            : itemInCart;

        // Pass selected item ids as query param or state (example with state)
        navigate(`/checkoutPreview/${id}`, { state: { items: itemsToCheckout } });
    };


    return (

        <div className="min-h-screen bg-white">
            {/* Navbar */}
            <header className="bg-white border-b border-orange-100 sticky top-0 z-50">
                <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    {/* Logo & Welcome */}
                    <div className="flex items-center gap-4">
                        <img src={user.image || UserLogo} alt="Logo" className="rounded-full h-10 w-10 object-contain" />
                        <h1 className="text-xl font-bold text-orange-500">
                            Hello, {user.name || 'User'} 👋
                        </h1>
                    </div>

                    {/* Search Bar */}
                    <div className="relative w-full max-w-md hidden md:block">
                        <input
                            type="text"
                            placeholder="Search meals..."
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                            className="w-full border border-orange-200 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        />
                        <FaSearch className="absolute left-3 top-2.5 text-orange-400" />
                    </div>

                    {/* Cart & Logout */}
                    <div className="flex items-center gap-8">
                        <button onClick={() => setIsCartOpen(true)} className="relative">
                            <FaShoppingCart className="text-3xl text-orange-500 cursor-pointer" />
                            <span className="absolute -top-2 -right-2 bg-orange-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                {itemInCart?.length}
                            </span>
                        </button>
                        <button onClick={() => setIsCartOpen(true)} className="relative">
                            <MdHistory className="text-4xl -mt-1.5 -mr-4 text-orange-500 cursor-pointer" />
                        </button>
                        <button
                            onClick={signOutUser}
                            type="button"
                            className="bg-transparent cursor-pointer text-white px-4 py-2 rounded-lg font-medium transition"
                        >
                            <PiSignOutBold className="text-red-600 text-3xl" />
                        </button>
                    </div>
                </div>
            </header>

            {/* Page Header */}
            <section className="text-center py-10 px-6">
                <h2 className="text-4xl font-extrabold text-gray-800">🍽️ Order Your Favorite Meals</h2>
                <p className="text-gray-500 mt-2">Fresh, fast, and delivered to your door.</p>
            </section>

            {/* Product Grid */}
            <div className="max-w-full mx-auto px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 pb-16">
                {filteredProducts.map((item) => {
                    const imageUrl = `http://127.0.0.1:8000/api/storage/${item.image}`
                    return <div key={item.id}>
                        <div
                            className="bg-white border border-orange-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col"
                        >
                            {item.is_available ? <p className="text-white text-sm px-2 py-1 rounded-2xl w-[5.5rem] text-center bg-green-500">
                                {item.is_available ? "Available" : "Unavailable"}
                            </p> : <p className="text-white text-sm px-2 py-1 rounded-2xl w-[6rem] text-center bg-red-500">
                                {item.is_available ? "Available" : "Unavailable"}
                            </p>
                            }
                            <img
                                src={imageUrl}
                                alt="Product"
                                className="w-full h-52 object-cover rounded-t-2xl"
                            />
                            <div className="p-6 flex flex-col flex-grow">
                                <div className="flex items-center justify-between mb-2">
                                    <h3 className="text-xl font-bold text-gray-800">{item.name}</h3>
                                    <span className="text-lg font-semibold text-orange-500">&#8369;{item.price}</span>
                                </div>
                                <span className="text-sm font-semibold text-gray-400">Category: {item.category}</span>
                                <span className="text-sm font-semibold text-gray-400 mb-5">Size: {item.size}</span>

                                {item.is_available ? <button onClick={() => addToCartItem(item)} className="cursor-pointer mt-auto bg-orange-500 hover:bg-orange-600 text-white w-full py-2.5 rounded-xl text-sm font-semibold transition duration-200">
                                    🛒 Add to Cart
                                </button> : <button disabled className="cursor-not-allowed mt-auto bg-red-500 hover:bg-red-600 text-white w-full py-2.5 rounded-xl text-sm font-semibold transition duration-200">
                                    Out of stock
                                </button>}

                            </div>
                        </div>
                    </div>
                })}
            </div>

            {/* Cart Container */}
            <div className={`fixed top-0 right-0 h-full w-full sm:w-[30rem] bg-white shadow-2xl transform transition-transform duration-300 z-50 ${isCartOpen ? 'translate-x-0' : 'translate-x-full'}`}>
                <div className="flex justify-between items-center px-6 py-4 border-b border-orange-100">
                    <h3 className="text-xl font-bold text-orange-500">Your Cart</h3>
                    <button
                        onClick={() => setIsCartOpen(false)}
                        className="text-orange-400 cursor-pointer hover:text-orange-600 font-semibold text-2xl"
                    >
                        ✖
                    </button>
                </div>

                {/* Cart Items Placeholder */}
                <div className="p-6 space-y-4 overflow-y-auto h-[calc(100%-140px)]">
                    {/* Example Item */}
                    <div className="flex flex-col gap-4">
                        {itemInCart?.map((item: TCartItem) => {
                            const imageUrl = `http://127.0.0.1:8000/api/storage/${item.image}`;
                            return (
                                <div
                                    key={item.id}
                                    className="flex items-center justify-between border-b pb-3"
                                >
                                    <div className="flex items-center gap-3">
                                        <input
                                            type="checkbox"
                                            checked={selectedItems.includes(String(item.id))}
                                            onChange={() => checkboxTheItem(item)}
                                            className="h-4 w-4 text-orange-500"
                                        />
                                        <img
                                            src={imageUrl}
                                            alt={item.name}
                                            className="w-18 h-16 rounded object-cover"
                                        />
                                        <div>
                                            <p className="font-semibold text-gray-700 text-sm">{item.name}</p>
                                            <p className="text-sm text-gray-400">{item.category}</p>
                                            <p className="text-sm text-gray-400">
                                                Qty: {item.quantity}
                                            </p>
                                            <span className="text-sm text-orange-500 font-bold whitespace-nowrap">
                                                &#8369;{item.price}
                                            </span>
                                        </div>
                                    </div>
                                    <div className="flex ml-28">
                                        <button
                                            onClick={() => minusQuantity(item)}
                                            type="button"
                                            className="px-2.5 bg-gray-50 text-sm cursor-pointer active:bg-gray-100"
                                        >-</button>
                                        <input className="w-8 text-[.80rem] px-auto text-center bg-gray-100" type="number" value={item.quantity} readOnly />
                                        <button onClick={() => addQuantity(item)} type="button" className="px-2 bg-gray-50 text-sm cursor-pointer active:bg-gray-100">+</button>
                                    </div>
                                    <span className="relative -mt-14">
                                        <button type="button" onClick={() => removeInCart(item)} >
                                            <GrAdd className="rotate-45 text-red-500 cursor-pointer" />
                                        </button>
                                    </span>
                                </div>
                            );
                        })}
                    </div>
                </div>

                {/* Checkout Button */}
                <div className="p-6 border-t border-orange-100">
                    <label htmlFor="checkAll">
                        <input
                            type="checkbox"
                            id="checkAll"
                            checked={!!itemInCart?.length && selectedItems.length === itemInCart.length}
                            onChange={() => checkAllItem(itemInCart)}
                            className="mr-1.5"
                        />
                        Check all
                    </label>
                    <div className="flex justify-end -mt-6">
                        <label className="mr-4 text-sm text-red-700">Total: &#8369;{totalPrice.toLocaleString("en-PH")}</label>
                        <button
                            type="button"
                            onClick={() => checkOutPreview(user.uId)}
                            className="w-30 cursor-pointer bg-orange-500 text-white py-2 rounded-md font-semibold text-sm transition hover:bg-orange-600"
                            disabled={!itemInCart || itemInCart.length === 0}
                        >
                            🧾 Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );

}
