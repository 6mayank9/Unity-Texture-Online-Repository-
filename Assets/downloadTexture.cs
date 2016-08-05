using UnityEngine;
using System.Collections;
using System.Collections.Generic;
public class downloadTexture : MonoBehaviour {
    private int count;
    private int cubesCount;
    public GameObject prefab;
    public GameObject[] cubes;
    bool flag;
    // Use this for initialization
    void Start() {
        flag = false;
        cubesCount = 10;
        cubes = new GameObject[cubesCount];
        getCount();
        
        
      
    }
    void getCount()
    {
        StartCoroutine(checkURL());
        
    }

    IEnumerator checkURL()
    {
        WWW www = new WWW("http://localhost/Mayank/getCount.php");
        yield return www;
        count = int.Parse(www.text);
        Debug.Log("Total Available Textures:" + count);
    }
    //public void Wrapper()
    //{
    //    StartCoroutine(webDown());
    //}

    public void TextureRandom()
    {
        //RandomTexture();

        StartCoroutine(RandomTexture());
        
    }
    IEnumerator RandomTexture()
    {
        
        List<int> randomList = new List<int>();
        
        int i = 0;
        int val ;
        while (i<cubesCount)
        {
            val = Random.Range(1, count);
            
                randomList.Add(val);
                Debug.Log(val);
                i++;
            
        }

        for (i = 0; i < cubesCount; i++)
        {
            
            string url = "http://localhost/Mayank/Textures/" + randomList[i] + ".jpg";
            float newPositionX = Random.Range(-3.7f, 3.7f);
            float newPositionY = Random.Range(-3.7f, 3.7f);
            float newPositionZ = Random.Range(-2.8f, 2.8f);
            GameObject cube = Instantiate(prefab, new Vector3(newPositionX, newPositionY, newPositionZ), Quaternion.identity) as GameObject;

            cube.GetComponent<Renderer>().material.mainTexture = new Texture2D(4, 4, TextureFormat.ARGB32, false);
            WWW www = new WWW(url);
            yield return www;
            www.LoadImageIntoTexture(cube.GetComponent<Renderer>().material.mainTexture as Texture2D);
            //Destroy(cube);
        }
        
    }
    public void LatestTextures()
    {
        StartCoroutine(TexturesLatest());
    }
    IEnumerator TexturesLatest()
    {
        int i = 0;
        int val = count;
        for (i = 0; i < cubesCount; i++, val--)
        {

            string url = "http://localhost/Mayank/Textures/" + val + ".jpg";
            float newPositionX = Random.Range(-3.7f, 3.7f);
            float newPositionY = Random.Range(-3.7f, 3.7f);
            float newPositionZ = Random.Range(-2.8f, 2.8f);
            GameObject cube = Instantiate(prefab, new Vector3(newPositionX, newPositionY, newPositionZ), Quaternion.identity) as GameObject;

            cube.GetComponent<Renderer>().material.mainTexture = new Texture2D(4, 4, TextureFormat.ARGB32, false);
            WWW www = new WWW(url);
            yield return www;
            www.LoadImageIntoTexture(cube.GetComponent<Renderer>().material.mainTexture as Texture2D);
        }
    }
    public void OldestTextures()
    {
        StartCoroutine(TexturesOldest());
    }
    IEnumerator TexturesOldest()
    {
        int i = 0;
        
        for (i = 0; i < cubesCount; i++)
        {

            string url = "http://localhost/Mayank/Textures/" + i + ".jpg";
            float newPositionX = Random.Range(-3.7f, 3.7f);
            float newPositionY = Random.Range(-3.7f, 3.7f);
            float newPositionZ = Random.Range(-2.8f, 2.8f);
            GameObject cube = Instantiate(prefab, new Vector3(newPositionX, newPositionY, newPositionZ), Quaternion.identity) as GameObject;

            cube.GetComponent<Renderer>().material.mainTexture = new Texture2D(4, 4, TextureFormat.ARGB32, false);
            WWW www = new WWW(url);
            yield return www;
            www.LoadImageIntoTexture(cube.GetComponent<Renderer>().material.mainTexture as Texture2D);
        }
    }
    
}
