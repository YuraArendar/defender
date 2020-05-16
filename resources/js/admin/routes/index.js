import Login from '../components/layouts/auth/login';
import Logout from '../components/layouts/auth/logout';
import Main from '../components/layouts/main/layout';
import Dashboard from '../components/dashboard/dashboard';

import structure from './structure';
import content from "./content";

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
        component: Main,
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: Dashboard
            },
            {
                ...structure
            },
            {
                ...content
            }
        ]
    },
];
