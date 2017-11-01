<ion-view view-title="比比旅行">

    <ion-nav-buttons side="right">
        <button class="button button-icon icon ion-compose" ng-click="showNewTopicModal()"></button>
    </ion-nav-buttons>

    <ion-content>
        <ion-refresher pulling-text="下拉刷新..." on-refresh="doRefresh()">
        </ion-refresher>

        <div ng-if="showloading" style="margin-top:60px; text-align: center">

            <ion-spinner icon="ios" style="height: 60px; width: 60px;;"></ion-spinner>
        </div>

        <ion-list class="topics"  ng-if="showloading==false">
            <ion-item collection-repeat="topic in threadlListData" href="#/tab/thread_content/{{topic.tid}}"
                      collection-item-width="'100%'" collection-item-height="65px">
                <!--  <img ng-src="{{ENV.imgUrl}}{{topic.pic}}">-->
                <h2>{{topic.subject}}</h2>
                <p class="summary">

                </p>
            </ion-item>
        </ion-list>
        <ion-infinite-scroll icon="ion-load-d"  on-infinite="loadMore()" distance="1%" ng-if="moreDataCanBeLoaded()"></ion-infinite-scroll>

    </ion-content>
</ion-view>
