<?php $this->load->view('common/header');?>
	<div>
        <form>
            <div class="form-group">
                <input class="form-control" name="title" placeholder="文章标题">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" rows="30" placeholder="文章内容"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="button" class="btn btn-default">保存草稿</button>
            </div>
        </form>
	</div>

<?php $this->load->view('common/footer');?>