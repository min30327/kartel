<template>
    <div id="p-dashboard">
        <div class="c-page__container">
            <div class="p-dashboard__header">
                <h1 class="p-dashboard__header--title c-title">Subscription</h1>
            </div>
            <section class="c-section">
                <div class="c-card__shadow">
                    <div class="c-card">
                        <div class="c-card__body">
                            <Loading v-if="processing" />
                            <div class="c-subscription c-amount" v-show="status=='unsubscribed'||status=='cancelled'">
                                <div class="c-subscription__content">
                                    <h4 class="c-subscription__heading">料金</h4>
                                    <div class="c-subscription__body">
                                        <div class="c-amount__price">¥2,980 <small> / 月</small></div>
                                    </div>
                                    <div class="c-payment" v-show="status=='unsubscribed'">
                                        <div class="c-card__error">{{ cardErrorMessage }}</div>
                                        <div id="c-payment__element" class="c-form__control"></div>
                                    </div>
                                </div>
                                <div class="c-subscription__button">
                                    <button class="c-button c-button__primary c-button__width-180 c-button__reset" @click="subscribe" v-if="status=='unsubscribed'" v-bind:disabled="cardErrorMessage!=''">KARTELに参加する</button>
                                    <button class="c-button c-button__primary c-button__width-180 c-button__reset" @click="resume" v-if="status=='cancelled'" v-bind:disabled="cardErrorMessage!=''">再度参加する</button>
                                </div>
                            </div>
                            <div v-show="status=='subscribed'">
                                <div class="c-launch__ovice--wrapper">
                                    <div class="c-launch__ovice">
                                        <a href="https://not4h.ovice.in/" class="c-button__reset c-button__ovice" target="_blank">
                                            <svg version="1.1" class="ovice-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2098.1 666.5" style="enable-background:new 0 0 2098.1 666.5;" xml:space="preserve">
                                                <g>
                                                    <path class="st0" d="M727.4,360.2c2.2-5.2,4.4-10.3,6.4-15.5c34.4-89.6,68.7-179.1,103-268.7c4.6-12.1,8.8-24.4,13.5-36.5c2.3-5.8,5.2-11.5,8.5-16.9c10.4-17.1,26.1-23.3,45.6-21c13,1.5,25.3,5.6,37.7,9.5c20.4,6.5,40.8,13.1,61.1,20c10.6,3.6,20.6,8.5,29.5,15.5c9.7,7.7,14.7,17.6,13.9,30c-0.4,6.4-1.3,12.9-2.9,19.2c-5,19.9-13.3,38.7-21.7,57.3C962.5,285,902.8,416.8,843.1,548.6c-4.7,10.4-10.5,20.1-18.2,28.5c-5.2,5.8-11.4,10-18.7,13c-51.8,20.9-104.6,39.3-157.2,58c-9.9,3.5-19.7,7.1-29.6,10.6c-1.5,0.5-3.1,1-5,1.6c-2-7-3.9-13.6-5.8-20.3c-30.2-108.3-60.5-216.5-90.6-324.8c-16.9-60.9-33.7-121.8-50.6-182.7c-4.3-15.5-9.1-31-13.4-46.5c-2.1-7.6-2.7-15.5-1.2-23.3c1.6-8.7,6.9-15,14.4-19.4c6.7-3.9,14-6.2,21.5-7.8c39.9-8.6,79-19.9,117.9-31.9c7.2-2.2,14.5-3.9,22.1-3.6c9,0.3,16,4.2,20.7,11.8c4.4,7.1,6.4,15,7.9,23c8.8,47.9,17.2,96,26.4,143.9c8.8,46.1,18.2,92,27.4,138.1c0.6,2.8,1,5.6,1.5,8.3c-0.6,1.3-1.5,2.5-1.9,3.9c-2,6.7-3.7,13.4-5.7,20c-8.6,29.9-17.2,59.7-25.9,89.6c-9.3,32.1-18.7,64.1-28.1,96.2c-9.7,33.2-19.4,66.3-29.1,99.5c-1,3.3-1.7,6.6-2.6,10c1.3-0.6,1.7-1.5,2.1-2.4c3.9-10.4,7.8-20.8,11.8-31.1c7.9-20.8,15.7-41.5,23.6-62.3c7.1-18.9,14.3-37.8,21.4-56.7c7.8-20.6,15.6-41.2,23.4-61.8c6.4-16.9,12.9-33.7,19.2-50.6C723.1,373,725.2,366.6,727.4,360.2z M619.3,646.9c-0.1-0.1-0.2-0.3-0.3-0.4c-0.1,0.3-0.3,0.5-0.4,0.8c0,0.1,0.2,0.2,0.3,0.4C619,647.4,619.2,647.1,619.3,646.9z M618.3,649.9c-0.1-0.1-0.2-0.2-0.3-0.4c-0.1,0.3-0.3,0.5-0.4,0.8c0,0.1,0.2,0.2,0.3,0.4C618,650.4,618.2,650.1,618.3,649.9z"/>
                                                    <path class="st1" d="M465.2,433.8c-0.3,131.4-107.2,233-233.1,232.7C107.3,666.3,0.1,565.6,0,433.9C-0.1,304.6,104.5,201,233,201.1C361.2,201.3,465.2,305.6,465.2,433.8z M322.3,435.3c-0.3-16.7-2.2-33.2-6.9-49.3c-6.3-21.1-16.1-40.1-32.1-55.5c-28.9-27.9-68.5-28.8-98.6-2.3c-10.5,9.3-18.8,20.3-24.8,32.9c-19.2,40.1-21.5,81.6-9.5,124c5.8,20.4,15.9,38.4,31.6,52.9c29.4,27.3,70.5,27.7,100.4,1c8-7.2,14.7-15.5,20.1-24.7C316.6,489.9,321.8,463.2,322.3,435.3z"/>
                                                    <path class="st1" d="M1909.4,657.6c-69.4-0.7-124.9-28.9-167.6-83.1c-20.6-26.2-35.1-55.2-41.8-88c-4.7-23.4-5.2-47-1.8-70.6c6.5-44.7,22.5-85.8,47.9-123.1c32.2-47.3,76.9-76,132.7-87.8c22.3-4.7,44.8-6.9,67.5-5.8c70.2,3.3,129.2,50.2,146.5,113.2c9.2,33.6,6.9,66-11.3,96.3c-12.3,20.5-29.8,35.7-50.2,47.6c-23.3,13.5-48.4,22.3-74.8,26.6c-21.7,3.5-43.6,5.6-65.4,8.3c-2.8,0.3-5.6,0.6-8.4,0.9c-12.7,1.7-19.2,16.2-11.5,26.5c13.3,17.7,31,27.9,53.3,29.5c19.9,1.5,39.2-2,58.3-6.6c22.2-5.4,43.8-12.4,65.3-20c4.4-1.5,8.7-2.3,13.2-0.9c5.2,1.7,9.3,5.1,10.7,10.3c4.8,18,9.5,36.1,8.6,55c-0.7,13.5-6.4,24.2-17.4,32.2c-10.2,7.4-21.9,12-33.7,15.8c-26.2,8.4-52.6,15.8-79.8,19.7C1936.3,655.6,1922.8,656.3,1909.4,657.6z M1867.4,391.4c4.9-0.9,10.8-1.4,16.3-3c12.7-3.7,25.4-7.8,38-12c10.5-3.6,21.1-7.1,31.2-11.6c5-2.2,9.5-6.1,13.5-10c5.1-5,6.4-11.6,4.2-18.5c-4.3-13.5-13.2-22.7-27.1-26c-19.3-4.7-37.1-0.4-52.7,11.5c-8,6.1-15.4,13.2-22.5,20.4c-4.5,4.6-8.2,10-11.9,15.4c-3.7,5.4-5.7,11.6-6.7,18.1c-1.2,7.9,2.3,13,9.9,14.8C1861.8,390.8,1864.2,391,1867.4,391.4z"/>
                                                    <path class="st1" d="M1530.2,657.2c-33.4-0.5-66.1-4.4-97.8-15.2c-34.8-11.8-64.9-30.6-88.6-59c-20.8-25-33.8-53.7-40.1-85.4c-10.8-54.6-6.2-108,17.9-158.5c34.1-71.6,90.8-115.8,167.8-134c20.8-4.9,42.1-6.7,63.5-5.9c10.1,0.4,20.2,1.7,30.3,3c15.2,2,30.3,4.1,45.4,7c7.6,1.4,15.1,4.1,22.2,7.2c16.7,7.2,24.7,20.5,25.5,38.4c0.7,15.3-2.2,30.2-5.4,45c-1.2,5.7-2.6,11.3-4.1,17c-3.2,12.1-11.8,17.4-24.1,15c-10.6-2.1-21.2-4.3-31.8-6.3c-18.2-3.3-36.3-7.1-54.9-6.8c-23.3,0.4-44.7,6.3-63.2,21c-9,7.1-16.4,15.6-22.5,25.3c-10.9,17.3-19.3,35.8-22.5,56.1c-6,38.4,6.1,70.6,34.5,96.7c11.7,10.8,26.3,16.1,42,18.3c15.6,2.2,31.2,1.1,46.8-0.6c16.5-1.8,32.4-5.4,48.1-10.6c11.7-3.9,23.4,4.5,24.1,16.7c1,17,1.7,34-0.1,50.9c-0.8,7.7-2.1,15.5-4.2,23c-4.3,15.5-14.4,25.9-29.5,31.6c-10.1,3.7-20.5,5.8-31.1,6.7C1562.5,655.3,1546.4,656.1,1530.2,657.2z"/>
                                                    <path class="st1" d="M1063.3,631.2c1.7-21,3.3-41.1,4.9-61.2c1.4-18.4,2.8-36.9,4.3-55.3c1.9-24.2,3.8-48.5,5.7-72.7c1-13.1,1.9-26.3,3.2-39.3c1.2-11.2,3-22.4,4.4-33.6c2-16.2,3.7-32.4,5.8-48.6c2.3-17.7,5-35.2,10.8-52.2c6.9-20.4,20.3-34.3,40.3-42.2c15.5-6.2,31.8-9.8,48.1-12.8c12.6-2.4,25.2-4.4,37.9-6.5c12.4-2.1,22.7,7.1,21.7,19.6c-2,23.9-4.3,47.8-6.4,71.6c-1.5,16.6-2.9,33.2-4.3,49.8c-1.8,20.7-3.7,41.5-5.6,62.2c-1.5,16.3-2.9,32.5-4.4,48.8c-1.8,19.7-3.7,39.5-5.6,59.2c-1.5,15.4-2.9,30.8-4.4,46.2c-0.7,7.1-1.2,14.3-2.2,21.4c-0.4,3.1-1.6,6.2-3.1,8.9c-5,8.8-11.8,15.6-21.6,19.1c-34.9,12.5-69.8,24.9-104.6,37.6C1075.7,655.3,1061,646.3,1063.3,631.2z"/>
                                                    <path class="st2" d="M1264.5,60c0,10.7,0.2,21.3-0.1,32c-0.2,5.6-0.9,11.3-2,16.8c-2.2,11.3-8.8,19.5-19.3,24.5c-9.6,4.5-19.7,7-30.1,8.7c-24.5,3.9-49,7.5-73.5,11.2c-3.1,0.5-6.3,1-9.4,1.2c-9.5,0.5-17-4.9-18.8-14.3c-3.9-20.7-6.4-41.4-3-62.5c3.6-22.2,15.3-38.6,35-49.4c14.2-7.7,29.5-12.4,45.3-14.9c17.9-2.9,35.9-5,53.9-6.9c12.2-1.3,20.5,6.6,20.9,18.7c0.2,5.8,0.3,11.7,0.4,17.5c0.1,5.8,0,11.6,0,17.5C1264,60,1264.2,60,1264.5,60z"/>
                                                    <path class="st3" d="M727.4,360.2c-2.2,6.4-4.3,12.8-6.7,19.1c-6.3,16.9-12.8,33.8-19.2,50.6c-7.8,20.6-15.6,41.2-23.4,61.8c-7.1,18.9-14.3,37.8-21.4,56.7c-7.9,20.8-15.7,41.5-23.6,62.3c-3.9,10.4-7.8,20.8-11.8,31.1c-0.3,0.9-0.8,1.8-2.1,2.4c0.9-3.3,1.6-6.7,2.6-10c9.7-33.2,19.4-66.3,29.1-99.5c9.4-32.1,18.7-64.1,28.1-96.2c8.7-29.9,17.3-59.7,25.9-89.6c1.9-6.7,3.7-13.4,5.7-20c0.4-1.4,1.2-2.6,1.9-3.9c3.3,7.7,6.6,15.5,9.9,23.2C724,352.3,725.7,356.2,727.4,360.2z"/>
                                                    <path class="st3" d="M619.3,646.9c-0.1,0.3-0.3,0.6-0.4,0.8c-0.1-0.1-0.3-0.3-0.3-0.4c0.1-0.3,0.2-0.6,0.4-0.8C619.1,646.6,619.2,646.7,619.3,646.9z"/>
                                                    <path class="st4" d="M618.3,649.9c-0.1,0.3-0.3,0.5-0.4,0.8c-0.1-0.1-0.3-0.3-0.3-0.4c0.1-0.3,0.2-0.5,0.4-0.8C618.1,649.6,618.2,649.8,618.3,649.9z"/>
                                                </g>
                                            </svg>
                                            <span>オフィスへ出社する</span>
                                        </a>
                                    </div>
                                    <div class="c-launch__ovice--comment">
                                        <p>
                                            oViceはホワイトリスト方式を取っています。<br>
                                            参加にはメールアドレスが必要です。
                                        </p>
                                        <button class="c-button__outline c-button__small" @click="modal_open">oViceへの入り方</button>
                                        <n-link to="/profile" class="c-button__outline c-button__small">プロフィールの編集</n-link>
                                    </div>
                                </div>
                                <div class="c-launch__discord--wrapper">
                                    <div class="c-launch__discord">
                                        <a v-bind:href="get_discord_url()" class="c-button__reset c-button__discord" target="_blank" v-if="$auth.user.discord_id!=null">
                                            <svg width="71" height="55" viewBox="0 0 71 55" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip1)"><path d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133 25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139 18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362 44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718 48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259 37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133 47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z" fill="#5865F2"/></g><defs><clipPath id="clip1"><rect width="71" height="55"/></clipPath></defs></svg>
                                            <span>専用チャットへ行く</span>
                                        </a>
                                        <a v-bind:href="get_discord_auth_url()" class="c-button__reset c-button__discord" v-if="$auth.user.discord_id==null">
                                            <svg width="71" height="55" viewBox="0 0 71 55" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip2)"><path d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133 25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139 18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362 44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718 48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259 37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133 47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z" fill="#5865F2"/></g><defs><clipPath id="clip2"><rect width="71" height="55"/></clipPath></defs></svg>
                                            <span>KALTELに参加する</span>
                                        </a>
                                    </div>
                                    <div class="c-launch__discord--comment">
                                        Discord側でサーバーから退出をしても月額課金は解除されません。予めご了承ください。
                                    </div>
                                </div>
                                <div class="c-subscription c-status">
                                    <div class="c-subscription__content">
                                        <h4 class="c-subscription__heading">ステータス</h4>
                                        <div class="c-subscription__body">
                                            <div class="c-status__data">
                                                <h4>参加中</h4>
                                                <p>¥2,980 / 月</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-subscription__button">
                                        <button class="c-button c-button__primary c-button__width-180 c-button__reset" @click="cancel">退会する</button>
                                    </div>
                                </div>
                            
                                <div class="c-credit__wrapper">
                                    <div class="c-subscription c-credit">
                                        <div class="c-subscription__content">
                                            <h4 class="c-subscription__heading">クレジットカード</h4>
                                            <div class="c-subscription__body">
                                                <div class="c-credit__data">
                                                    <h4>カード下4桁</h4>
                                                    <p>…<span v-text="$auth.user.pm_last_four"></span></p>
                                                </div>
                                            </div>
                                            <div class="c-payment">
                                                <div class="c-card__error">{{ cardErrorMessageEdit }}</div>
                                                <div id="c-payment__element--edit" class="c-form__control"></div>
                                            </div>
                                        </div>
                                        <div class="c-subscription__button">
                                            <button class="c-button c-button__secondary c-button__width-180 c-button__reset" @click="updateCard" v-bind:disabled="cardErrorMessageEdit!=''">カードを変更する</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>

        <div class="c-howto__ovice" v-if="modal_opened" v-scroll-lock="modal_opened">
            <div class="c-howto__ovice--overlay" @click="modal_close"></div>
            <div class="c-howto__ovice--content">
                <div class="c-howto__ovice--body">
                    <button class="c-howto__ovice--close" @click="modal_close"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></button>
                    <h4 class="c-howto__ovice--title">oViceへの入り方</h4>
                    <ol class="c-howto__ovice--order">
                        <li><a href="https://not4h.ovice.in/" target="_blank">https://not4h.ovice.in</a> にアクセス</li>
                        <li>「すでにアカウントを持っている」をクリック</li>
                        <li>会員登録のタブに切り替え</li>
                        <li>ホワイトリスト登録されたメールアドレスで登録</li>
                        <li>入室</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const elementStyles = {
    base: {
        color: '#32325D',
        fontWeight: 500,
        fontSize: '16px',
        fontSmoothing: 'antialiased',

        '::placeholder': {
            color: '#CFD7DF',
        },
        ':-webkit-autofill': {
            color: '#e39f48',
        },
    },
    invalid: {
        color: '#E25950',

        '::placeholder': {
            color: '#FFCCA5',
        },
    },
};
export default {
    middleware: ['auth'],
    layout: 'admin',
    head() {
        return {
            title: "Dashboard｜"
        }
    },
    data() {
        return {
            modal_opened: false,
            processing :true,
            status: '',
            cardErrorMessage :"",
            cardErrorMessageEdit :"",
            cardElement: null,
            cardElementEdit: null,
            guild_id  : process.env.GUILD_ID
        }
    },
    async mounted (){

        const params = new URLSearchParams(window.location.search);
        const joined = params.get('joined');
        if(joined){
            if(joined==this.$auth.user.discord_id ){
                this._toast("success","KARTELに入会しました。")
            }
        }
        const withdrawal = params.get('withdrawal');
        if(withdrawal){
            if(withdrawal==this.$auth.user.id ){
                this._toast("success","KARTELを退会しました。")
            }
        }
        
        await this.$axios.get('Stripe/status')
        .then(this.setStatus);

        await this.$nextTick()

        this.processing = false

        const payment_el =  document.querySelector('#c-payment__element')
        if(payment_el){
            const elements = this.$stripe.elements()
            const card = elements.create('card', {style:elementStyles,hidePostalCode: true})
            card.mount('#c-payment__element')
            card.on('change', this.showCardError)
            this.cardElement = card
        }

        const payment_edit_el =  document.querySelector('#c-payment__element--edit')
        if(payment_edit_el){
            const elements_edit = this.$stripe.elements()
            const card_edit = elements_edit.create('card', {style:elementStyles,hidePostalCode: true})
            card_edit.mount('#c-payment__element--edit')
            card_edit.on('change', this.showCardErrorEdit)
            this.cardElementEdit = card_edit
        }
    },
    methods: {
        get_discord_url(){
            if(this.$ua.isFromPc()){
                return 'discord://discordapp.com/channels/' + this.guild_id
            }else{
                return 'com.hammerandchisel.discord://discordapp.com/channels/' + this.guild_id
            }
        },
        get_discord_auth_url(){
            return process.env.API_BASE_URL + '/api/Discord/auth'
        },
        showCardError(event) {
            if (event.error) {
                this.cardErrorMessage = event.error.message
            } else {
                this.cardErrorMessage = ''
            }
        },
        showCardErrorEdit(event) {
            if (event.error) {
                this.cardErrorMessageEdit = event.error.message
            } else {
                this.cardErrorMessageEdit = ''
            }
        },
        async subscribe(e) {
            
           
            const paymentMethod = await this.getPaymentMethod(e.target,this.cardElement);
            if(!paymentMethod){
                return false
            }
            this.processing = true
            const url = '/Stripe/subscribe';
            const params = {
                payment_method: paymentMethod.id
            };
            this.$axios.post(url, params)
            .then(response => {
                this.processing = false
                location.href = process.env.API_BASE_URL + '/api/Discord/auth'
            })
            .catch(error => {
                this.processing = false
                this._toast("error","KARTELに参加できませんでした。")
            })

        },
        cancel() {
            if(window.confirm('KARTELを退会します。よろしいですか？')){
                this.processing = true
                const url = '/Stripe/cancel';
                this.$axios.post(url)
                .then(() => {
                    this.setStatus
                    this.processing = false
                    location.href = process.env.API_BASE_URL + '/api/Discord/kick/' + this.$auth.user.id 
                })
                .catch(error => {
                    this.processing = false
                })
            }
        },
        resume() {

            this.processing = true
            const url = '/Stripe/resume';
            this.$axios.post(url)
            .then(() => {
                this.setStatus

                this.processing = false
                location.href = process.env.API_BASE_URL + '/api/Discord/auth'
            })

            .catch(error => {
                this.processing = false
            })
        },
        async updateCard(e) {

            const paymentMethod = await this.getPaymentMethod(e.target,this.cardElementEdit);

            if(!paymentMethod){
                return false
            }
            this.processing = true
            const url = '/Stripe/update_card';
            const params = { 
                payment_method: paymentMethod.id
            };
            this.$axios.post(url, params)
            .then(response => {
                this.processing = false
                this._toast("success","カード情報を変更しました。")
                this.cardElementEdit.clear()
                this.$auth.fetchUser()
            })
            .catch(error => {
                this.processing = false
                this._toast("error","Kartelに参加できませんでした。")
            })

        },
        setStatus(response) {
            this.status = response.data.status;
            this.details = response.data.details;

        },
        async getPaymentMethod(target,cardEl) {

            const {paymentMethod, error} = await this.$stripe.createPaymentMethod({
                type: 'card',
                card: cardEl,
                billing_details: {
                    name: this.$auth.user.name,
                    email:  this.$auth.user.email,
                },
            });
            return paymentMethod;
        },
        _toast(type,message=""){
            
            this.$toast[type](message, {
                position: "top-right"
            })
        },
        modal_close(){
            this.modal_opened = false
        },
        modal_open(){
            this.modal_opened = true
        },
    },
    computed: {
        isSubscribed() {
            return (this.status === 'subscribed' || this.status === 'cancelled');
        },
        isCancelled() {
            return (this.status === 'cancelled');
        }
    },
}
</script>

<style lang="scss" scoped="true">
.c-section{
    margin-bottom: 30px;
}
.c-subscription{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    .c-subscription__content{
        max-width: calc(100% - 240px);
        flex: 0 0 calc(100% - 240px);
        display: flex;
        flex-wrap: wrap;
        @media (max-width: 767px) {      
            max-width: 100%;
            flex: 0 0 100%;
            display: block;
            text-align: center;
        }
    }
    .c-subscription__button{

        align-self: flex-end;
        max-width: 180px;
        flex: 0 0 180px;
        @media (max-width: 767px) {
            max-width: 100%;
            flex: 0 0 100%;
            text-align: center;
            padding-top: 20px;
        }
    }
    .c-subscription__heading{
        margin: 0;
        padding: 0;
        font-size: .9rem;
        color: $gray;
        flex: 0 0 150px;
        max-width: 150px;
        @media (max-width: 767px) {
            display: block;
            max-width: 100%;
            margin-right: 20px;
        }
    }
    .c-subscription__body{
        flex: 0 0 calc(100% - 150px);
        max-width: calc(100% - 150px);
        
        @media (max-width: 767px) {
            display: inline-block;
            max-width: 100%;
        }
    }
}
.c-amount{
    .c-amount__price{
        letter-spacing: .4px;
        font-size: 1.5rem;
        font-weight: bold;
        small{
            font-size: 0.7rem;
            font-weight: normal;
        }
    }
}
.c-status{
    .c-status__data{
        h4{
            margin: 0;
            padding: 0;
            display: inline;
            margin-right: 15px;
            font-weight: bold;
            font-size: .9rem;
        }
        p{
            padding: 0;
            margin: 0;
            display: inline;
            font-size: .8rem;
        }
    }
}
.c-credit__wrapper{
    position: relative;
    margin-top: 50px;
    padding-top: 50px;
    @media(max-width: 767px){
        padding-top:  30px;
        margin-top: 30px;
    }
    &::before{
        content:"";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 1px;
        background: #f1f1f1;
    }
}
.c-credit{
    
    .c-credit__data{
        h4{
            margin: 0;
            padding: 0;
            display: inline;
            margin-right: 15px;
            font-weight: bold;
            font-size: .9rem;
        }
        p{
            margin: 0;
            display: inline;
            font-size: .8rem;
        }
    }
}
.c-payment{
    width: 100%;
    padding-top:10px;
}
.c-card__error{
    font-size: 11px;
    color: $danger;
}
.c-launch__ovice--wrapper{
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
    align-items: center;

    @media (max-width:767px) {
        margin-bottom: 30px;
    }
    .c-launch__ovice--comment{
        flex: 0 0 50%;
        max-width: 50%;
        color: $gray;
        font-size: 0.8rem;
        line-height: 1.6;
        @media (max-width:767px) {
            flex: 0 0 100%;
            max-width: 100%;
        }
        button{
            margin-right: 3px;
        }
        p{
            line-height: 1.4;
            padding: 0;
            margin: 0;
            margin-bottom: 5px;
        }
    }
}
.c-launch__ovice{
    flex: 0 0 50%;
    max-width: 50%;
    @media (max-width:767px) {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .c-button__ovice{
        display: flex;
        align-items: center;
        border: 1px solid #eee;
        padding: 23px 15px;
        font-size: 14px;
        font-weight: bold;
        border-radius: $border-radius;
        color:$base-color;
        margin-right: 30px;
        @include easeOutQuart(300ms);
        transition-property: background;
        @media (max-width:767px) {
            margin-right: 0;
            margin-bottom: 15px;
        }
        &:hover,&:focus,&:active{
            background: #fafafa;
        }
        svg{
            width: 60px;
            margin:10px 20px;
            @media (max-width:575px) {
                width: 50px;
                margin:10px 10px;
            }
            @media (max-width:374px) {
                width: 35px;
            }
        }
        span{
            margin-left: 20px;
            @media (max-width:575px) {
                margin-left: 15px;
            }
            @media (max-width:374px) {
                margin-left: 10px;
                white-space: nowrap;
            }
        }
        .ovice-logo{
            .st0{fill:#081A30;}
            .st1{fill:#091A30;}
            .st2{fill:#091B31;}
            .st3{fill:#4E5A6B;}
            .st4{fill:#3C4B5C;}
        }
    }
}

.c-launch__discord--wrapper{
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 60px;
    align-items: center;

    .c-launch__discord--comment{
        flex: 0 0 50%;
        max-width: 50%;
        color: $gray;
        font-size: 0.8rem;
        line-height: 1.6;
        @media (max-width:767px) {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
}
.c-launch__discord{

    position: relative;
    flex: 0 0 50%;
    max-width: 50%;
    @media (max-width:767px) {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .c-button__discord{
        padding: 13px 15px;
        border-radius: $border-radius;
        color:$discord-color;
        display: flex;
        align-items: center;
        border: 1px solid #eee;
        font-size: 14px;
        font-weight: bold;
        margin-right: 30px;

        @include easeOutQuart(300ms);
        transition-property: background;
        @media (max-width:767px) {
            margin-right: 0;
            margin-bottom: 15px;
        }
        &:hover,&:focus,&:active{
            background: #fafafa;
        }
        svg{
            width: 50px;
            margin:10px 20px;
            @media (max-width:575px) {
                width: 50px;
                margin:10px 10px;
            }
            @media (max-width:374px) {
                width: 35px;
            }
        }
        span{
            margin-left: 30px;
            @media (max-width:575px) {
                margin-left: 15px;
            }
            @media (max-width:374px) {
                margin-left: 10px;
                white-space: nowrap;
            }
        }
    }
}

.c-howto__ovice{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 2000;
    .c-howto__ovice--overlay{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.7);
        z-index: 1;
    }

    .c-howto__ovice--close{
        position: absolute;
        right:10px;
        top: 10px;
        width: 40px;
        height: 40px;
        background: rgba(0,0,0,0);
        border-radius: 30px;
        border: none;
        text-align: center;
        cursor: pointer;
        svg{
            width: 15px;
            margin: 0 auto;
        }
    }
    .c-howto__ovice--content{
        position: relative;
        z-index: 2;
        width: 500px;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        height: 100%;
        align-items: center;

        .c-howto__ovice--body{
            position: relative;
            padding: 30px 40px;
            background-color: #fff;
            border-radius: 12px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .c-howto__ovice--title{
            text-align: center;
            font-size: 22px;
            padding: 0;
        }
        ol{
            list-style: none;
            margin: 0;
            padding: 0;
            counter-reset: cnt;
            li{
                line-height: 1.5;
                font-size: 14px;
                margin-bottom: 25px;
                counter-increment: cnt;
                position: relative;
                padding-left: 40px;
                &::before{
                    content:counter( cnt ) "";
                    position: absolute;
                    width: 25px;
                    height: 25px;
                    text-align: center;
                    line-height: 25px;
                    left: 0;
                    top: 0;
                    background-color: $gray;
                    color: #fff;
                    border-radius: 20px;
                }
            }
        }
    }
}
</style>