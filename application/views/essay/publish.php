<?php $this->load->view('common/header'); ?>
    <div>
        <form id="essay-publish">
            <div class="form-group">
                <input class="form-control" name="essay_title" maxlength="100" placeholder="标题">
            </div>
            <div class="form-group">
                <input class="form-control" name="essay_sub_title" maxlength="300" placeholder="副标题">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="essay_content" rows="32" placeholder="正文"></textarea>
            </div>
            <div class="form-group">
                <label>选择文章分类：</label>
                <select class="input-sm" name="essay_category">
                    <option value=""></option>
                    <?php foreach ($essay_category as $item) { ?>
                        <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                    <?php } ?>
                </select>
                <span class="pull-right">
                    <!-- 先实现保存单独文章，后续再加入新增章节文章功能 -->
                    <input type="hidden" name="essay_type" value="1">
                    <button class="btn btn-primary essay-publish-btn">发布</button>
                    <button class="btn btn-default essay-draft-btn">保存草稿</button>
                </span>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('assets/js/essay.js') ?>"></script>
<?php $this->load->view('common/footer'); ?>