export default ({ app }, inject) => {
  window.dataLayer = window.dataLayer || []
  function gtag() {
    // eslint-disable-next-line no-undef
    dataLayer.push(arguments)
  }
  gtag('js', new Date())

  // 今回は二つのトラッキングIDを設定します。環境変数などを利用するなり適宜設定してください。
  gtag('config', process.env.GATAG)
//   gtag('config', process.env.AW_TRACKING_ID)

  // routeが切り替わるたびにgtagを呼び出す
  app.router.afterEach((to) => {
    // ページの構築が終わるまで少し待つ
    setTimeout(() => {
      gtag('event', 'page_view', {
        location_path: `${window.location.origin}${to.fullPath}`,
        page_path: to.fullPath,
        page_title: document.title,
      })
    }, 300)
  })

  // gtagをinjectして、他のコンポーネントから this.$gtag で呼び出せるようにする。
  inject('gtag', gtag)
}