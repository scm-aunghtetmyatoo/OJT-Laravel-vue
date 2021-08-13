const UserList = () => import('./components/user/List.vue')
const UserCreate = () => import('./components/user/Create.vue')
const UserEdit = () => import('./components/user/Edit.vue')

const PostList = () => import('./components/post/List.vue')
const PostCreate = () => import('./components/post/Create.vue')
const PostEdit = () => import('./components/post/Edit.vue')

const Login = () => import('./components/auth/Login.vue')


export const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
          auth: false
        }
    },

    {
        name: 'categoryList',
        path: '/',
        component: PostList
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