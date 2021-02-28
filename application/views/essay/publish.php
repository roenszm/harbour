<?php $this->load->view('common/header');?>
	<div>
        <form id="essay-publish">
            <div class="form-group">
                <input class="form-control" name="essay_title" placeholder="标题">
            </div>
            <div class="form-group">
                <input class="form-control" name="essay_sub_title" placeholder="副标题">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="essay_content" rows="32" placeholder="正文"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="essay_id" value="0" >
                <a class="btn btn-primary essay-publish-btn">发布</a>
                <a class="btn btn-default essay-draft-btn">保存草稿</a>
            </div>
        </form>
	</div>
    <script src="<?php echo base_url('assets/js/essay.js') ?>"></script>
<?php $this->load->view('common/footer');?>