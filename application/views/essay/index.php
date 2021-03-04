<?php $this->load->view('common/header'); ?>
    <div>
        <?php if ($this->session->has_userdata('user_pri') && ($this->session->userdata('user_pri') == 0)) { ?>
            <a class="btn btn-primary" href="<?php echo site_url('/essay/new') ?>">新增文章</a>
        <?php } ?>
        <div class="essay-list">
            <table class="table table-striped">
                <tbody>
                <?php foreach ($essay_list as $row) { ?>
                    <tr>
                        <td width="90%">
                            <a href="#"><?php echo $row["title"]; ?></a>
                        </td>
                        <td>
                            <a href="#"><?php echo $row['username']; ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
<?php $this->load->view('common/footer'); ?>