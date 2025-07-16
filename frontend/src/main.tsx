import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.tsx'
import Login from './pages/Login.tsx'
import Menu from './pages/Menu.tsx'
import About from './pages/About.tsx'
import Home from './pages/Home.tsx'
import UserInformation from './pages/UserInformation.tsx'
import { createBrowserRouter, RouterProvider } from 'react-router-dom'
import CheckoutPreview from './pages/CheckoutPreview.tsx'
import ViewHistory from './pages/ViewHistory.tsx'

const routes = createBrowserRouter([
  {
    path: '/',
    element: <App />,
  },
  {
    path: '/login',
    element: <Login />,
  },
  {
    path: '/menu',
    element: <Menu />,
  },
  {
    path: '/about',
    element: <About />
  },
  {
    path: '/home',
    element: <Home />
  },
  {
    path: '/user-information',
    element: <UserInformation />
  },
  {
    path: '/view-history',
    element: <ViewHistory />
  },
  {
    path: '/checkoutPreview/:id',
    element: <CheckoutPreview />
  }
])

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <RouterProvider router={routes} />
  </StrictMode>,
)
