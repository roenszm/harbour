<?php $this->load->view('common/header'); ?>
    <div>
        <?php if ($this->session->has_userdata('user_pri') && ($this->session->userdata('user_pri') == 0)) { ?>
            <a class="btn btn-primary" href="<?php echo site_url('/essay/new') ?>">新增文章</a>
        <?php } ?>
        <div class="essay-page">
            <?php foreach ($essay_list as $row) { ?>
                <div class="essay-item">
                    <div class="row">
                        <div class="col-md-10">
                            <h4>
                                <small>
                                    <?php if ($row['type'] == 1) { ?>
                                        <span class="glyphicon glyphicon-file text-primary" aria-hidden="true"
                                              title="独立文章"></span>
                                    <?php } elseif ($row['type'] == 2) { ?>
                                        <span class="glyphicon glyphicon-th-list text-primary" aria-hidden="true"
                                              title="分章节文章"></span>
                                    <?php } ?>
                                </small>
                                <span class="label label-info"><?php echo $row['category_name']; ?></span>
                                <a href="<?php echo site_url('essay/'.$row['id']) ?>"><b><?php echo $row['title']; ?></b></a>
                            </h4>
                            <p class="grey"><?php echo $row['subtitle']; ?></p>
                        </div>
                        <div class="col-md-2">
                            <a href="#"><?php echo $row['username']; ?></a>
                            <p class="text-muted">
                                <small><?php echo $row['status_time']; ?></small>
                            </p>
                        </div>
                    </div>
                    <!--
                    <div>
                        <p class="text-muted">
                            标签：
                        </p>
                    </div>
                    -->
                </div>
            <?php } ?>

            <ul class="pagination">
                <li <?php if ($page <= 1){ ?>class="disabled"<?php } ?>>
                    <a <?php if ($page > 1){ ?>href="<?php echo site_url('essay') ?>"<?php } ?> aria-label="First">
                        <span aria-hidden="true">首页</span>
                    </a>
                </li>
                <li <?php if ($page <= 1){ ?>class="disabled"<?php } ?>>
                    <a <?php if ($page > 1){ ?>href="<?php echo $page > 2 ? site_url('essay/page/' . ($page - 1)) : site_url('essay') ?>"<?php } ?>
                       aria-label="Previous">
                        <span aria-hidden="true">上一页</span>
                    </a>
                </li>
                <li class="active">
                    <a><?php echo $page; ?></a>
                </li>
                <li <?php if ($page >= $total_page){ ?>class="disabled"<?php } ?>>
                    <a <?php if ($page < $total_page){ ?>href="<?php echo site_url('essay/page/' . ($page + 1)); ?>"<?php } ?>
                       aria-label="Next">
                        <span aria-hidden="true">下一页</span>
                    </a>
                </li>
                <li <?php if ($page >= $total_page){ ?>class="disabled"<?php } ?>>
                    <a <?php if ($page < $total_page){ ?>href="<?php echo site_url('essay/page/' . $total_page); ?>"<?php } ?>
                       aria-label="Last">
                        <span aria-hidden="true">末页(共<?php echo $total_page; ?>页)</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
<?php $this->load->view('common/footer'); ?>