const UserList = () => import('./components/user/List.vue')
const UserCreate = () => import('./components/user/Create.vue')
const UserEdit = () => import('./components/user/Edit.vue')

const PostList = () => import('./components/post/List.vue')
const PostCreate = () => import('./components/post/Create.vue')
const PostEdit = () => import('./components/post/Edit.vue')
const Upload = () => import('./components/post/Upload.vue')

const Secret = () => import('./components/auth/Secret.vue')


const Welcome = () => import('./components/Welcome.vue')



export const routes = [
    {
        path: '/secret',
        name: 'secret',
        component: Secret,
    },
    
     

    {
        name: 'categoryList',
        path: '/',
        component: Welcome
    },
    {
        name: 'postList',
        path: '/posts',
        component: PostList
    },
    {
        name: 'postCreate',
        path: '/posts/create',
        component: PostCreate
    },
    {
        name: 'postEdit',
        path: '/posts/:id/edit',
        component: PostEdit
    },
    {
        name: 'postUpload',
        path: '/posts/upload',
        component: Upload
    },

    {
        name: 'userList',
        path: '/users',
        component: UserList
    },
    {
        name: 'userEdit',
        path: '/users/:id/edit',
        component: UserEdit
    },
    {
        name: 'userCreate',
        path: '/users/create',
        component: UserCreate
    },

    
]