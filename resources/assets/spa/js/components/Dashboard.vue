<template>
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 z-depth-2 panel">
                <h3 class="center">Dashboard</h3>

            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {User} from '../services/resources';

    export default {
        ready() {
            User.get().then((response) => {
                console.log(response.data);
            });
        }
    }
</script>