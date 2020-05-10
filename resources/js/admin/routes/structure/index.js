import Structure from "../../components/structure/structure";
import AddStructure from "../../components/structure/add";
import EditStructure from "../../components/structure/edit";
import FormEdit from "../../components/structure/edit-form";

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
            component: EditStructure,
            children: [
                {
                    path: '/',
                    name: 'edit_structure',
                    component: FormEdit,
                }
            ]
        },
    ]
}
