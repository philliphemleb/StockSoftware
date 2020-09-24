import axios from "axios";

const backendUrl = "http://localhost/StockSoftware/public/";

export default {
    async fetchItems(search, skip)
    {
        const { data } = await axios.get(backendUrl + "/item?skip=" + skip + "&search=" + search)
        return data;
    }
}
