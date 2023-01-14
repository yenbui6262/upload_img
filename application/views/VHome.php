<style>
    img{
        width: 300px;
    }
    .col-md-4{
        margin-bottom: 10px;
    }
</style>
<div class="container">
    <div class="col-sm-4 col-md-offset-4">
        <br><br>
        <form class="form-horizontal" id="submit">
            <div class="form-group">
                <input type="file" name="files[]" id="file" class="file" multiple="multiple" >
            </div>

            <div class="form-group">
                <button class="btn btn-success" name="action" value="upload" id="btn_upload" type="submit">Upload</button>
            </div>
        </form>   
    </div>
    <div class="row" id="ketqua">
        {foreach $anh as $k => $v}
        <div class="col-md-4">
            <img src="{$url}/public/img/{$v['tLink']}" alt="anh">
        </div>
        {/foreach}
    </div>
</div>
<script src="{$url}/public/script/home.js"></script>