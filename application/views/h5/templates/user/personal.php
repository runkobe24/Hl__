<ion-view view-title="比比旅行">
  <ion-content class="setting">

    <ion-list>
      <ion-item class="item-divider item-gap">
      </ion-item>

      <ion-item class="item-avatar item-icon-right">


          <img src="img/commentfailure.png" class="avatar">

          <h2>{{userInfo.username}}</h2>

      </ion-item>
      <ion-item>
        积分
        <span class="item-note">
        100
        </span>
      </ion-item>
      <ion-item>
        注册日期
        <span class="item-note">
            2015-02-18

        </span>
      </ion-item>



        <button class="button button-block button-light"  ng-click="logout()">
          退出当前账号
        </button>



  </ion-content>
</ion-view>
