import Structure from "../../components/structure/structure";
import AddStructure from "../../components/structure/add";
import EditStructure from "../../components/structure/edit";
import FormEdit from "../../components/structure/edit-form";
import Meta from "../../components/structure/structure-meta";
import Content from "../../components/structure/structure-content";

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
                },
                {
                    path: 'meta',
                    name: 'meta_structure',
                    component: Meta
                },
                {
                    path: 'content',
                    name: 'content_structure',
                    component: Content
                }
            ]
        },
    ]
}
