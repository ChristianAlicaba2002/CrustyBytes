import { NavLink } from "react-router-dom"
import logo from "../assets/images/logo.webp"
export default function Navbar() {

    return (
        <>
            <nav className="w-full bg-orange-400 p-4 fixed top-0 z-50 shadow-md">
                <div className="container mx-auto flex justify-between items-center">
                    <div className="text-black text-lg font-bold flex-shrink-0">
                        <a href="/">
                            <img src={logo} alt="Logo" className="h-10 rounded-full ml-2 sm:ml-10" />
                        </a>
                    </div>
                    {/* Hamburger menu for mobile */}
                    <div className="lg:hidden">
                        <button
                            type="button"
                            className="text-black focus:outline-none"
                            onClick={() => {
                                const menu = document.getElementById('navbar-menu');
                                if (menu) menu.classList.toggle('hidden');
                            }}
                        >
                            <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                    {/* Menu */}
                    <ul
                        id="navbar-menu"
                        className="hidden lg:flex flex-col lg:flex-row lg:items-center lg:space-x-16 text-center absolute lg:static top-16 left-0 w-full lg:w-auto bg-orange-400 lg:bg-transparent z-40"
                    >
                        <li>
                            <NavLink to="/" className={({ isActive }) => `block py-2 lg:py-0 hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>Home</NavLink>
                        </li>
                        <li>
                            <NavLink to="/menu" className={({ isActive }) => `block py-2 lg:py-0 hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>Menu</NavLink>
                        </li>
                        <li>
                            <NavLink to="/about" className={({ isActive }) => `block py-2 lg:py-0 hover:text-white ${isActive ? 'text-white' : 'text-black'}`}>About Us</NavLink>
                        </li>
                        <li className="lg:ml-8">
                            <NavLink to="/login" className={({ isActive }) => `block py-2.5 px-4 rounded-md hover:text-white bg-orange-500 ${isActive ? 'text-white' : 'text-black'}`}>Sign In</NavLink>
                        </li>
                    </ul>
                </div>
            </nav>
        </>
    )
}
