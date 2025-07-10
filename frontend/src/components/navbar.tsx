import { NavLink } from "react-router-dom"
import logo from "../assets/images/logo.webp"
export default function Navbar() {

    return (
        <>
            <nav className="w-full bg-orange-400 p-4 fixed top-0 z-50 shadow-md">
                <div className="container flex justify-between items-center">
                    <div className="text-black text-lg font-bold">
                        <a href="/">
                            <img src={logo} alt="Logo" className="h-10 rounded-full ml-10"  /></a>
                    </div>
                    <ul className="flex justify-center space-x-16 text-center">
                        <li>
                            <NavLink to="/" className={({ isActive }) => `hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>Home</NavLink>
                        </li>
                        <li>
                            <NavLink to="/menu" className={({ isActive }) => `hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>Menu</NavLink>
                        </li>
                        <li>
                            <NavLink to="/about" className={({ isActive }) => `hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>About Us</NavLink>
                        </li>

                        <li className="mr-[-15rem]">
                            <NavLink to="/login" className={({ isActive }) => `py-2.5 px-4 rounded-md hover:text-white bg-orange-500 ${isActive ? 'text-white' : 'text-black'}`}>Sign In</NavLink>
                        </li>

                    </ul>
                </div>
            </nav>
        </>
    )
}
