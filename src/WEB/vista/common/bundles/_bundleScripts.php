<!-- Add the following at the end of your body tag -->
<?php if(SERVIDOR_PRUEBAS): ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
<?php else:?>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js"></script>
<?php endif;?>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.7.5/dist/quasar.umd.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.7.5/dist/lang/es.umd.prod.js"></script>
<script>
    const app = Vue.createApp({
        setup() {
            const leftDrawerOpen = Vue.ref(true);
            let isActiveDarkMode = false;
            
            if(Quasar.Cookies.has('darkMode') && Quasar.Cookies.get('darkMode').toLowerCase() === 'true'){
                isActiveDarkMode = true;
            }
             
            const darkMode = Vue.ref(isActiveDarkMode);
            Quasar.Dark.set(isActiveDarkMode);
            return {
                darkMode,
                leftDrawerOpen,
                toggleLeftDrawer() {
                    leftDrawerOpen.value = !leftDrawerOpen.value;
                },
                toggleDarkMode() {
                    Quasar.Cookies.set('darkMode', darkMode.value);
                    Quasar.Dark.set(darkMode.value);
                }
            };
        }
    });

    app.use(Quasar, {
        config: {
        }
    });
    Quasar.lang.set(Quasar.lang.es);
    app.mount('#q-app');
</script>