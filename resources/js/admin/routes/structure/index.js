import Structure from "../../components/structure/structure";
import AddStructure from "../../components/structure/add";
import EditStructure from "../../components/structure/edit";

export default {
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
