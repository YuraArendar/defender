import Login from '../components/layouts/auth/login';
import Logout from '../components/layouts/auth/logout';
import Main from '../components/layouts/main/layout';
import Structure from '../components/structure/structure';
import EditStructure from '../components/structure/edit';
import AddStructure from '../components/structure/add';
import Dashboard from '../components/dashboard/dashboard';

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
                path: 'structure',
                component: Structure,
                children: [
                    {
                        path: '/',
                        name: 'index_structure',
                        component: AddStructure
                    },
                    {
                        path: 'add',
                        name: 'add_structure',
                        component: AddStructure
                    },
                    {
                        path: ':id/edit',
                        name: 'edit_structure',
                        component: EditStructure
                    },
                ]
            }
        ]
    },
];
