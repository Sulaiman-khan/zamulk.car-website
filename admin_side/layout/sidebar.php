<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>

                    <?php if ($this->auth->admin_perm_auth('dashboard', 'view')) : ?>
                        <a class="nav-link <?= ($this->uri->segment(2) == 'dashboard' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/dashboard") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                    <?php endif ?>


                    <?php if (
                        $this->auth->admin_perm_auth('orders', 'view') ||
                        $this->auth->admin_perm_auth('reviews', 'view')
                    ) : ?>
                        <?php if ($this->auth->admin_perm_auth('orders', 'view')) : ?>
                            <div class="sb-sidenav-menu-heading">Orders</div>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'orders' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/orders") ?>" data-bs-toggle="collapse" data-bs-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'orders' ? 'show' : '' ?>" id="collapseOrders" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'orders' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/orders") ?>">All Orders</a>
                                </nav>
                            </div>

                            <?php if ($this->auth->admin_perm_auth('reviews', 'view')) : ?>
                                <a class="nav-link <?= $this->uri->segment(2) !== 'reviews' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/reviews") ?>" data-bs-toggle="collapse" data-bs-target="#collapseReviews" aria-expanded="false" aria-controls="collapseReviews">
                                    <div class="sb-nav-link-icon"><i class="fas fa-star-half-alt"></i></div>
                                    Reviews
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?= $this->uri->segment(2) == 'reviews' ? 'show' : '' ?>" id="collapseReviews" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'reviews' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/reviews") ?>">All Reviews</a>
                                    </nav>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (
                        $this->auth->admin_perm_auth('items', 'view') ||
                        $this->auth->admin_perm_auth('products', 'view') ||
                        $this->auth->admin_perm_auth('products', 'add') ||
                        $this->auth->admin_perm_auth('quotations', 'view')
                    ) : ?>
                        <div class="sb-sidenav-menu-heading">Products</div>

                        <?php if (
                            $this->auth->admin_perm_auth('products', 'view') ||
                            $this->auth->admin_perm_auth('products', 'add')
                        ) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'products' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/products") ?>" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                <div class="sb-nav-link-icon"><i class="fab fa-schlix"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'products' ? 'show' : '' ?>" id="collapseProducts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('products', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'products' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/products") ?>">All Products</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('products', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'products' && $this->uri->segment(3) == 'new') ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/products/new") ?>">Add New</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if ($this->auth->admin_perm_auth('items', 'view')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'items' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/items") ?>" data-bs-toggle="collapse" data-bs-target="#collapseItems" aria-expanded="true" aria-controls="collapseItems">
                                <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                                Items
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'items' ? 'show' : '' ?>" id="collapseItems" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'items' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/items") ?>">All Items</a>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if ($this->auth->admin_perm_auth('quotations', 'view')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'quotations' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/quotations") ?>" data-bs-toggle="collapse" data-bs-target="#collapseQuotations" aria-expanded="true" aria-controls="collapseQuotations">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment-dollar"></i></div>
                                Quotations
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'quotations' ? 'show' : '' ?>" id="collapseQuotations" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'quotations' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/quotations") ?>">All Quotations</a>
                                </nav>
                            </div>
                        <?php endif ?>

                    <?php endif ?>

                    <?php if (
                        $this->auth->admin_perm_auth('admins', 'view') ||
                        $this->auth->admin_perm_auth('admins', 'add') ||
                        $this->auth->admin_perm_auth('users', 'view')
                    ) : ?>
                        <div class="sb-sidenav-menu-heading">Accounts</div>
                        <?php if ($this->auth->admin_perm_auth('admins', 'view')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'users' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/users") ?>" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'users' ? 'show' : '' ?>" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'users' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/users") ?>">All Users</a>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if ($this->auth->admin_perm_auth('admins', 'view') || $this->auth->admin_perm_auth('admins', 'add')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'admins' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/admins") ?>" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                                Admins
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'admins' ? 'show' : '' ?>" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('admins', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'admins' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/admins") ?>">All Admins</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('admins', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'admins' && $this->uri->segment(3) == 'new') ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/admins/new") ?>">Add New</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>
                    <?php endif ?>


                    <?php if ($this->auth->admin_perm_auth('admin_roles', 'view') || $this->auth->admin_perm_auth('admin_roles', 'add') || $this->auth->admin_perm_auth('user_roles', 'view')) : ?>
                        <div class="sb-sidenav-menu-heading">ACL</div>
                        <?php if ($this->auth->admin_perm_auth('user_roles', 'view')) : ?>
                            <a class="nav-link <?= ($this->uri->segment(2) == 'user_roles') ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/user_roles") ?>" data-bs-toggle="collapse" data-bs-target="#collapseUserACL" aria-expanded="false" aria-controls="collapseUserACL">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                                User ACL
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= ($this->uri->segment(2) == 'user_roles') ? 'show' : '' ?>" id="collapseUserACL" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('user_roles', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'user_roles' && !$this->uri->segment(3))  ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/user_roles") ?>">Manage ACL</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>
                        <?php if ($this->auth->admin_perm_auth('admin_roles', 'view') || $this->auth->admin_perm_auth('admin_roles', 'add')) : ?>
                            <a class="nav-link <?= ($this->uri->segment(2) == 'roles') ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/roles") ?>" data-bs-toggle="collapse" data-bs-target="#collapseAdminACL" aria-expanded="false" aria-controls="collapseAdminACL">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-shield"></i></div>
                                Admin ACL
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= ($this->uri->segment(2) == 'roles') ? 'show' : '' ?>" id="collapseAdminACL" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('admin_roles', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'roles' && !$this->uri->segment(3))  ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/roles") ?>">Manage ACL</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('admin_roles', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'acl' && $this->uri->segment(3) == 'add_role' && !$this->uri->segment(4)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/roles/new") ?>">Add Role</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (
                        $this->auth->admin_perm_auth('blogs', 'view') ||
                        $this->auth->admin_perm_auth('blogs', 'add') ||
                        $this->auth->admin_perm_auth('news', 'view') ||
                        $this->auth->admin_perm_auth('news', 'add') ||
                        $this->auth->admin_perm_auth('cms', 'view') ||
                        $this->auth->admin_perm_auth('cms', 'add')
                    ) : ?>
                        <div class="sb-sidenav-menu-heading">CMS</div>

                        <?php if (
                            $this->auth->admin_perm_auth('cms', 'view') ||
                            $this->auth->admin_perm_auth('cms', 'add')
                        ) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'cms' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/cms") ?>" data-bs-toggle="collapse" data-bs-target="#collapseCMS" aria-expanded="false" aria-controls="collapseCMS">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                CMS
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'cms' ? 'show' : '' ?>" id="collapseCMS" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('cms', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'cms' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/cms") ?>">All CMS</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('cms', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'cms' && $this->uri->segment(3) == 'new') ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/cms/new") ?>">Add New</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if (
                            $this->auth->admin_perm_auth('blogs', 'view') ||
                            $this->auth->admin_perm_auth('blogs', 'add')
                        ) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'blogs' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/blogs") ?>" data-bs-toggle="collapse" data-bs-target="#collapseBlogs" aria-expanded="false" aria-controls="collapseBlogs">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-blogger"></i></div>
                                Blogs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'blogs' ? 'show' : '' ?>" id="collapseBlogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('blogs', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'blogs' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/blogs") ?>">All Blogs</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('blogs', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'blogs' && $this->uri->segment(3) == 'new') ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/blogs/new") ?>">Add New</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if (
                            $this->auth->admin_perm_auth('news', 'view') ||
                            $this->auth->admin_perm_auth('news', 'add')
                        ) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'news' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/news") ?>" data-bs-toggle="collapse" data-bs-target="#collapseNews" aria-expanded="false" aria-controls="collapseNews">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-rss"></i></div>
                                News
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'news' ? 'show' : '' ?>" id="collapseNews" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($this->auth->admin_perm_auth('news', 'view')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'news' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/news") ?>">All News</a>
                                    <?php endif ?>
                                    <?php if ($this->auth->admin_perm_auth('news', 'add')) : ?>
                                        <a class="nav-link <?= ($this->uri->segment(2) == 'news' && $this->uri->segment(3) == 'new') ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/news/new") ?>">Add New</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (
                        $this->auth->admin_perm_auth('email_logs', 'view') ||
                        $this->auth->admin_perm_auth('admin_activities', 'view')
                    ) : ?>
                        <div class="sb-sidenav-menu-heading">Logs</div>
                        <?php if ($this->auth->admin_perm_auth('admins_activities', 'view')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'admin_activity' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/admin_activity") ?>" data-bs-toggle="collapse" data-bs-target="#collapseAdminLogs" aria-expanded="false" aria-controls="collapseAdminLogs">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-dumpster-fire"></i></div>
                                Admin Logs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'admin_activity' ? 'show' : '' ?>" id="collapseAdminLogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'admin_activity' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/admin_activity") ?>">All Admins Logs</a>
                                </nav>
                            </div>
                        <?php endif ?>

                        <?php if ($this->auth->admin_perm_auth('email_logs', 'view')) : ?>
                            <a class="nav-link <?= $this->uri->segment(2) !== 'email_logs' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/email_logs") ?>" data-bs-toggle="collapse" data-bs-target="#collapseEmailLogs" aria-expanded="false" aria-controls="collapseEmailLogs">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-dumpster"></i></div>
                                Email Logs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= $this->uri->segment(2) == 'email_logs' ? 'show' : '' ?>" id="collapseEmailLogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'email_logs' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/email_logs") ?>">All Email Logs</a>
                                </nav>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (
                        $this->auth->admin_perm_auth('settings', 'view')
                    ) : ?>
                        <div class="sb-sidenav-menu-heading">Settings</div>
                        <a class="nav-link <?= $this->uri->segment(2) !== 'settings' ? 'collapsed' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/settings") ?>" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cog"></i></div>
                            Settings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= $this->uri->segment(2) == 'settings' ? 'show' : '' ?>" id="collapseSettings" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php if ($this->auth->admin_perm_auth('settings', 'view')) : ?>
                                    <a class="nav-link <?= ($this->uri->segment(2) == 'news' && !$this->uri->segment(3)) ? 'active' : '' ?>" href="<?= base_url("{$this->uri->segment(1)}/settings") ?>">Settings</a>
                                <?php endif ?>
                            </nav>
                        </div>
                    <?php endif ?>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $this->session->userdata('admin_role_name') ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">