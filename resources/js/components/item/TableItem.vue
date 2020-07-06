<template>
    <tr>
        <td v-for="item in rows" class="border px-4 py-2 break-all">{{ item }}</td>
        <td class="border px-4 py-2 break-all">
            <div class='flex justify-center'>
                <a :href='edit_route' class='bg-gray-300 hover:bg-blue-500 text-black font-bold py-2 px-4 rounded-l far fa-eye'></a>
                <form :action="delete_route" method='POST'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <input type='hidden' name='_token' :value='csrf_token'>
                    <button type='submit' class='bg-gray-900 hover:bg-red-300 text-red-500 font-bold py-2 px-4 rounded-r far fa-trash'></button>
                </form>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            'rows': {type: Array, required: true},
            'edit_route': {type: String, required: true},
            'delete_route': {type: String, required: true},
            'csrf_token': {type: String, required: true},
        },

        data: function () {
            return {

            }
        },

        methods: {
            test: function () {

            }
        }
    }
</script>
