function hideemptyads()
{
    var all_div = $(".advisionad");
    var pattern = "<a";
    for ( var i = 0; i < all_div.length; i++)
    {
        html = all_div[i].innerHTML;
        if (!html.match(pattern))
        {
            all_div[i].style.display = 'none';
        }
    }

}

function autoIframe(frameId)
{
    try
    {
        frame = document.getElementById(frameId);
        innerDoc = (frame.contentDocument) ? frame.contentDocument
                : frame.contentWindow.document;
        var height=0;
        var width=0;
        if (innerDoc == null)
        {
            // Google Chrome
            height = document.all[frameId].clientHeight
                    + document.all[frameId].offsetHeight
                    + document.all[frameId].offsetTop;
            width = document.all[frameId].clientWidth
            + document.all[frameId].offsetWidth
            + document.all[frameId].offsetLeft;
        } else
        {
                height = innerDoc.body.scrollHeight + 18;
                width = innerDoc.body.scrollWidth + 18;
        }
        jQuery("#"+frameId).height(height);
        jQuery("#"+frameId).width(width);
    }

    catch (err)
    {
        alert('Err: ' + err.message);
        window.status = err.message;
    }
}