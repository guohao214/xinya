<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/weui.min.css">
<link rel="stylesheet" href="<?php echo get_instance()->config->base_url(); ?>static/frontend/css/makers.css">
<style>
    .weui-btn_primary{
        width: 60%;
        margin: 0 auto;
    }

    .wrapper {
        margin-top: 50px;
    }
    .wrapper span {
        display: block;
        width: 80%;
        margin: 0 auto;
        font-size: 18px;
        text-align: center;
        margin-bottom: 30px;
    }
    .guide {
      position: fixed;
      left: 0;
      bottom: 0px;
      height: 400px;
      width: 100%;
      background-color: white;
      border-top:1px solid #ccc;
      box-sizing: border-box;
      padding: 10px;
      overflow-y: scroll;
      z-index: 999;
      display: none;
    }
    .maskLayer {
      position: fixed;
      z-index: 998;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(0,0,0,0.3);
      display: none;
    }

    .use_guide {
      width: 100%;
      text-align: center;
      display: inline-block;
      padding: 15px 0;
      color: coral;
      text-decoration: underline;
      font-size: 15px;
    }
    .guide div {
      margin: 10px 0;
      font-size: 15px;
    }
</style>
<header><h2>申请成为推广大使</h2></header>
<section class="detail">
    <div class="wrapper">
        <span>请点击下面的按钮申请成为推广大使</span>
        <a href="javascript:;" class="weui-btn weui-btn_primary" id="confirm-submit">确定申请</a>

      <a class="use_guide">查看帮助</a>
    </div>
</section>

<div class="maskLayer"></div>
<div class="guide">
  <div>
    <p>1. 我居然是推广大使？</p>
    <p>&nbsp;&nbsp;&nbsp;没错，消费满999元您就可以成为不期而遇的推广大使。(线下消费满999可以在线申请) 推广大使肩负“健康自我，帮助他人”的美好使命。我们时刻以你为荣哦。</p>
  </div>

  <div>
    <p>2. 怎么使用您的专属推广大使二维码呢？</p>
    <p>&nbsp;&nbsp;&nbsp;长按图片即可保存您的二维码图片至手机相册。如果您想邀请他人，通过微信或者QQ将您的二维码图片发送给他，
      让她长按识别二维码按照提示操作就能完成购买项目。</p>
    <p>&nbsp;&nbsp;&nbsp也可直接点击右上角的“分享”按钮， 一键将您的二维码名片发送至朋友圈让更多的人受益哦！</p>
  </div>

  <div>
    <p>3. 成为推广大使的好处是？</p>
    <p>&nbsp;&nbsp;&nbsp;当您朋友扫描您的二维码成功购买项目或套餐后，您将获得相应比例返现， 具体返现金额您试试就知道啦，自己享受健康之余动动手指头就可以有收益何乐而不为呢？毕竟财富是慢慢积累起来的嘛！
    </p>
    <p>&nbsp;&nbsp;&nbsp分享健康和美本身就是幸福快乐的事，将自己的二维码图片分享到您的社交圈，帮助身边的人重视健康和保养，养生预防胜过治疗，今天不养生明天养医生这些道理大家都懂的， 为“全民健康”贡献一份自己的力量吧。不期而遇感谢有您！</p>
  </div>
</div>


<script>
  $(document).ready(function () {
      $('.use_guide').on('click', function () {
          $('.maskLayer').add($('.guide')).fadeIn();
      })

      $('.maskLayer').on('click', function () {
          $('.maskLayer').add($('.guide')).fadeOut();
      })
  })
</script>

<script type="text/javascript"
        src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/apply_makers.js"></script>
