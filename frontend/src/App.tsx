import { useState, useEffect } from "react";
import { getAuth } from "firebase/auth";
import { Link , useNavigate} from "react-router-dom"
import "./App.css"
import Navbar from "./components/navbar"


function App() {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const auth = getAuth()
  const navigate = useNavigate()


  useEffect(() => {
    try {
        const isUserSignEnd = auth.onAuthStateChanged((auth) => {
          if(auth)
          {
            navigate('/home')
          }
        })
        return() => isUserSignEnd()
    } catch (error) {
      console.log('something is error', error)
    }
  }, [auth, navigate])


  useEffect(() => {
    setTimeout(() => {
      setIsLoading(true);
    }, 1000);
  }, []);

  return (
    <>
      <Navbar />
      {isLoading ? (
        <main className="p-18 bg-amber-50 w-[90%] mt-[12rem] ml-16 font-sans text-left text-gray-800">
          <h1 className="text-4xl font-bold mb-4 text-orange-600 flex items-center">
            <span className="pizza-span mr-2">🍕</span> Welcome to <span className="ml-2 font-extrabold text-4xl">CRUSTYBYTES</span>
          </h1>

          <p className="text-lg mb-4">
            Craving something amazing? We've got you covered! Enjoy fast, fresh, and flavor-packed meals delivered straight to your door.
          </p>

          <p className="text-base text-gray-700 mb-4">
            Explore a menu carefully crafted with handpicked ingredients, authentic flavors, and a touch of culinary magic. Whether it's lunch, dinner, or a late-night snack — we deliver joy in every bite!
          </p>

          <ul className="list-disc pl-6 text-sm text-gray-600 mb-6 space-y-1">
            <li>✅ Curated Menu by Professional Chefs</li>
            <li>🚀 Fast & Reliable Delivery</li>
            <li>🍝 Local Favorites & Signature Dishes</li>
            <li>💳 Easy Online Payments</li>
          </ul>

          <Link to="/menu"
            className="bg-orange-600 w-[11%] hover:bg-orange-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 text-base flex items-center gap-2"
          >
            🍽️ View Menu
          </Link>
        </main>
      ) : (
        <div className="flex items-center justify-center min-h-screen bg-amber-50">
          <div className="loader"></div>
        </div>
      )}
    </>
  )
}

export default App
