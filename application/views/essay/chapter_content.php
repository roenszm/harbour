<?php $this->load->view('common/header'); ?>
    <div class="essay-page">
        <?php if ($essay_info['type'] == 1) { ?>
            <div class="alert alert-info">
                本文位于章节文章《<a
                        href="#"><?php echo $essay_info['title']; ?></a>》的<?php echo "第" . $essay_content['index'] . "/" . $chapter_num . "篇。"; ?>
                <a class="btn btn-info btn-sm">返回章节列表</a>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-8">
                <div class="bottom-20">
                    <h3>
                        <?php echo $essay_content['chapter_title']; ?>
                    </h3>
                    <h4 class="text-muted"><?php echo $essay_content['chapter_subtitle']; ?></h4>
                </div>
                <p><?php echo $essay_content['chapter_content']; ?></p>
            </div>
            <div class="col-xs-4">
                <div>
                    <a class="btn btn-primary btn-sm">返回文章列表</a>

                </div>
                <h4 class="text-primary"><?php echo $essay_content['username']; ?></h4>
                <p>发布于 <?php echo $essay_content['publish_time']; ?></p>
                <?php if ($essay_content['modify_time'] <> "0000-00-00 00:00:00") { ?>
                    <p>编辑于 <?php echo $essay_content['modify_time']; ?></p>
                <?php } ?>
                <p>文章分类：<?php echo $essay_info['category_name']; ?></p>
            </div>

        </div>

    </div>
<?php $this->load->view('common/footer'); ?>