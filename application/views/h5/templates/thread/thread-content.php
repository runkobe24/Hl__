
<ion-view hide-tabs view-title="比比旅行">

    <ion-content padding="true">

     <div class="first_thread">
        <h3>{{thread[0]['subject']}}</h3>

         <div ng-bind-html="thread[0]['message']"></div>

     </div>


        <div class="replay">
            <hr>
            <ul>
                <li ng-repeat="(key,val) in thread" ng-if="key>0">

                    <div ng-bind-html="val['message']"></div>
                    <br><br> <br><br> <br><br> <br><br>
                </li>

            </ul>



        </div>

    </ion-content>
</ion-view>