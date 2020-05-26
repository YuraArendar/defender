import Content from '../../components/content/content';
import Edit from '../../components/content/edit';
import EditForm from '../../components/content/edit-form';
import ContentMeta from '../../components/content/content-meta';

export default {
    path: 'content',
    component: Content,
    children: [
        {
            path: ':structureId/:contentId/edit',
            component: Edit,
            children: [
                {
                    path: '/',
                    name: 'edit_content',
                    component: EditForm
                },
                {
                    path: 'meta',
                    name: 'meta_content',
                    component: ContentMeta
                }
            ]
        }
    ]
}
