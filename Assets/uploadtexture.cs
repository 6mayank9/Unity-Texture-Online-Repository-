using UnityEngine;
using System.Collections;
using System.IO;
public class uploadtexture : MonoBehaviour {
    //public GameObject obj;
    // Use this for initialization
    public void WebUpload()
    {
        Debug.Log("flag");
        var uploadURL = "http://localhost/Mayank/unityUpload.php";
        // Create a texture the size of the screen, RGB24 format
        Texture2D savedTexture = gameObject.GetComponent<Renderer>().material.mainTexture as Texture2D;
        if (savedTexture == null)
        {
            Debug.Log("Empty");
        }
        Texture2D newTexture = new Texture2D(savedTexture.width, savedTexture.height, TextureFormat.ARGB32, false);

        newTexture.SetPixels(0, 0, savedTexture.width, savedTexture.height, savedTexture.GetPixels());
        //newTexture = FillInClear(newTexture);
        newTexture.Apply();
        var bytes = newTexture.EncodeToPNG();
        // Encode texture into PNG
        //var bytes = tex.EncodeToPNG();
        Destroy(newTexture);
        // Create a Web Form
        var form = new WWWForm();
        form.AddField("frameCount", Time.frameCount.ToString());
        form.AddBinaryData("file", bytes, "texture.png", "image/png");
        //File.WriteAllBytes("abc.png",bytes);
        // Upload to a cgi script    
        WWW w = new WWW(uploadURL, form);
        //yield return w;

        if (w.error != null)
        {
            Debug.Log(w.error);
        }
        else
        {
            Debug.Log("Finished Uploading Texture");
        }
    }
    void Start () {
        
        
    }
    
    // Update is called once per frame
    void Update () {
	
	}

    
}
