import Login from '../components/layouts/auth/login';
import Logout from '../components/layouts/auth/logout';
import Main from '../components/layouts/main/layout';

export const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout
    },
    {
        path: '/',
        name: 'main',
        component: Main
    },
];
