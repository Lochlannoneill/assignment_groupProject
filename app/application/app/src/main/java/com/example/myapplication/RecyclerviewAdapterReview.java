package com.example.myapplication;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

public class RecyclerviewAdapterReview extends RecyclerView.Adapter<RecyclerviewAdapterReview.ViewHolder>{

    //    Context context;
    String[] reviewerName, reviewerRating, reviewerMessage;
    private LayoutInflater layoutInflater;


    public RecyclerviewAdapterReview(String[] rn, String[] rr, String[] rm){
//        context = ctxt;
        reviewerName = rn;
        reviewerRating = rn;
        reviewerMessage = rm;
    }


    @NonNull
    @Override
    public RecyclerviewAdapterReview.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
//        layoutInflater = LayoutInflater.from(context);
        layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.row_review, parent, false);
        return new RecyclerviewAdapterReview.ViewHolder(view);
    }


    @Override
    public int getItemCount() {
        return reviewerName.length;
    }


    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView text_reviewer_name, text_reviewer_rating, text_reviewer_message;
        ConstraintLayout layout;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            text_reviewer_name = itemView.findViewById(R.id.reviewer_name);
            text_reviewer_rating = itemView.findViewById(R.id.reviewer_rating);
            text_reviewer_message = itemView.findViewById(R.id.reviewer_message);
            layout = itemView.findViewById(R.id.layout);
        }
    }


    @Override
    public void onBindViewHolder(@NonNull RecyclerviewAdapterReview.ViewHolder holder, final int index) {
        holder.text_reviewer_name.setText(reviewerName[index]);
        holder.text_reviewer_rating.setText(reviewerRating[index]);
        holder.text_reviewer_message.setText(reviewerMessage[index]);
//        holder.layout.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent intent = new Intent(context, SecondActivity.class);
//                intent.putExtra("name", names[index]);
//                intent.putExtra("fact", facts[index]);
//                intent.putExtra("image", images[index]);
//                intent.putExtra("url", urls[index]);
//                context.startActivity(intent);
//            }
//        });

    }

}
