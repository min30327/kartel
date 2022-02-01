
const _toast = (me,type,message="") => {
            
    me.$toast[type](message, {
        position: "top-center"
    })
}
const _toHankaku = (str) => {
    return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}
const _render = (me,str) => {
    str = me.$sanitize(str)
    str = me.$options.filters.escape(str)
    str = me.$options.filters.linkify(str)
    str = me.$options.filters.nl2br(str)
    return str
}
const get_graph = ( data,post,breadcrumbs ) => {

    
    const graph = [
        {
            "@type":"Organization",
            "@id":process.env.BASE_URL + "/#organization",
            "url":process.env.BASE_URL + "/",
            "name": process.env.BASE_ORGANIZATION,
            "sameAs":[],
            "logo":{
                "@type":"ImageObject",
                "@id":process.env.BASE_URL + "/#logo",
                "url":process.env.BASE_URL + process.env.BASE_OGP ,
                "image":{
                    "@id": process.env.BASE_URL + "/#logo"
                },
            }
        },
        {
            "@type":"WebSite",
            "@id":process.env.BASE_URL + "/#website",
            "url":process.env.BASE_URL + "/",
            "name": process.env.BASE_TITLE,
            "publisher":{"@id":process.env.BASE_URL + "/#organization"},
            "potentialAction":{"@type":"SearchAction",
            "target":process.env.BASE_URL + "/?s={search_term_string}",
            "query-input":"required name=search_term_string"}
        },
        
    ]

    graph.push({
        "@type":"WebPage",
        "@id": data.url + "#webpage",
        "url": data.url + "",
        "inLanguage":"ja",
        "name": data.title,
        "isPartOf":{"@id": data.url + "/#website"},
        "breadcrumb":{"@id": data.url + "#breadcrumblist"},
        "description":data.description,
        "about":{"@id": data.url + "/#organization"}
    })
    if(post){
        graph.push({
            "@type": "Article",
            "@id": data.url + "/#article",
            "isPartOf": {
                "@id": data.url + "/#webpage"
            },
           
            "headline":data.title,
            "image": data.ogp,
            "datePublished": data.date,
            "dateModified": data.modified,
            "commentCount": 0,
            "mainEntityOfPage": {
                "@id": data.url + "/#webpage"
            },
            "publisher": {
                "@id": process.env.BASE_URL + "/#organization"
            },
            "articleSection": data.type,
        })
    }
    const itemListElement = [];

    breadcrumbs.forEach( (item,index) => {
        itemListElement.push({
            "@type":"ListItem",
            "position":index+1,
            "item":{
                "@type":item.type,
                "@id":item.url,
                "url":item.url,
                "name": item.name
            }
        })
    });
    graph.push({
        "@type":"BreadcrumbList",
        "@id": data.url + "#breadcrumblist",
        "itemListElement":itemListElement
    })
    return graph;
}

export default ({ app }, inject) => {
    inject('get_graph',get_graph)
    inject('_toast',_toast)
    inject('_toHankaku',_toHankaku)
    inject('_render',_render)
}