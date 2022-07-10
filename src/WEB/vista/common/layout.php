<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $view->headTitulo; ?></title>
        <?php require_once 'bundles/_bundleStyles.php'; ?>
    </head>
    <body>
        <div id="q-app">
            <q-layout view="lHh Lpr lff" container style="height: 100vh" class="shadow-2">
                <q-header reveal bordered class="bg-primary text-white">
                    <q-toolbar>
                        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer"></q-btn>
                        <q-toolbar-title class="gt-sm">Lambda Framework</q-toolbar-title>
                        <q-space class="lt-sm"></q-space>
                        <q-toggle
                            v-model="darkMode"
                            color="warning"
                            @update:model-value="toggleDarkMode()"
                        >
                            <q-tooltip>Modo Oscuro</q-tooltip>
                        </q-toggle>
                        <?php if(HABILITA_AUTENTICACION): ?>
                            <q-btn align="between" dense flat class="btn-fixed-width" icon="logout" href="/Login/salir" label="Salir"></q-btn>
                        <?php endif;?>
                    </q-toolbar>
                </q-header>

                <q-drawer
                    v-model="leftDrawerOpen"
                    show-if-above
                    :width="220"
                    :breakpoint="400"
                    >
                    <q-scroll-area style="height: calc(100% - 150px); margin-top: 150px; border-right: 1px solid #ddd">
                        <q-list padding>
                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <q-icon name="inbox" />
                                </q-item-section>

                                <q-item-section>
                                    Inbox
                                </q-item-section>
                            </q-item>

                            <q-item active clickable v-ripple>
                                <q-item-section avatar>
                                    <q-icon name="star" />
                                </q-item-section>

                                <q-item-section>
                                    Star
                                </q-item-section>
                            </q-item>

                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <q-icon name="send" />
                                </q-item-section>

                                <q-item-section>
                                    Send
                                </q-item-section>
                            </q-item>

                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <q-icon name="drafts" />
                                </q-item-section>

                                <q-item-section>
                                    Drafts
                                </q-item-section>
                            </q-item>
                        </q-list>
                    </q-scroll-area>

                    <q-img class="absolute-top" src="/assets/img/material.png" style="height: 150px">
                        <div class="absolute-bottom bg-transparent">
                            <q-avatar size="56px" class="q-mb-sm">
                                <img src="/assets/img/undraw_co-working_re_w93t.svg">
                            </q-avatar>
                            <div class="text-weight-bold">Razvan Stoenescu</div>
                            <div>@rstoenescu</div>
                        </div>
                    </q-img>
                </q-drawer>

                <q-page-container>
                    <q-page padding>
                        <?= $view->buffer ?>
                    </q-page>
                </q-page-container>

            </q-layout>
        </div>
        <?php require_once 'bundles/_bundleScripts.php';?>
    </body>
</html>