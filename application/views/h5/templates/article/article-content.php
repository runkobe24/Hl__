
<ion-view view-title="比比旅行">

    <ion-content padding="true">
{{hideTabs}}
        <div ng-if="showloading" style="margin-top:60px; text-align: center">

            <ion-spinner icon="ios" style="height: 60px; width: 60px;;"></ion-spinner>
        </div>
        <div ng-if="showloading==false" class="article_content" ng-bind-html="NewsContentData[0]['content']"></div>

    </ion-content>
</ion-view>